<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Concerns\UploadsImages;
use App\Mail\NewsletterMail;
use App\Models\BlogPost;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    use UploadsImages;

    public function index()
    {
        $posts = BlogPost::withTrashed()->latest()->get();
        return view('admin.blog.index', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'    => 'required|string|max:255',
            'category' => 'required|in:news,event,tour,upcoming',
            'excerpt'  => 'nullable|string',
            'content'  => 'nullable|string',
            'image'    => 'nullable|image|max:4096',
        ]);

        $image   = null;
        $imageId = null;

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $uploadedUrl = $this->uploadImage($request->file('image'), 'ubuvivi/blog');
            if ($uploadedUrl) {
                $image = $uploadedUrl;
                Log::info('Blog image uploaded successfully: ' . $uploadedUrl);
            } else {
                Log::warning('Blog image upload returned null for post: ' . $request->title);
                return redirect()->back()->with('error', 'Image upload failed. Please try again.');
            }
        }

        $post = BlogPost::create([
            'title'        => $request->title,
            'slug'         => Str::slug($request->title) . '-' . uniqid(),
            'category'     => $request->category,
            'excerpt'      => $request->excerpt,
            'content'      => $request->content,
            'image'        => $image,
            'image_id'     => $imageId,
            'published'    => $request->has('published'),
            'published_at' => $request->has('published') ? now() : null,
        ]);

        if ($request->has('published')) {
            $this->notifySubscribers($post);
        }

        return redirect()->route('blog.admin.index')->with('success', 'Post created successfully.');
    }

    public function getData($id)
    {
        $post = BlogPost::findOrFail($id);
        return response()->json([
            'id'        => $post->id,
            'title'     => $post->title,
            'category'  => $post->category,
            'excerpt'   => $post->excerpt,
            'content'   => $post->content,
            'image'     => $post->image,
            'published' => $post->published,
        ]);
    }

    public function update(Request $request, $id)
    {
        $post = BlogPost::findOrFail($id);

        $request->validate([
            'title'    => 'required|string|max:255',
            'category' => 'required|in:news,event,tour,upcoming',
            'excerpt'  => 'nullable|string',
            'content'  => 'nullable|string',
            'image'    => 'nullable|image|max:4096',
        ]);

        $image   = $post->image;
        $imageId = $post->image_id;

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $newUrl = $this->uploadImage($request->file('image'), 'ubuvivi/blog');
            if ($newUrl) {
                $image   = $newUrl;
                $imageId = null;
                Log::info('Blog image updated successfully: ' . $newUrl);
            } else {
                Log::warning('Blog image update failed for post ID: ' . $id);
                return redirect()->back()->with('error', 'Image upload failed. Please try again.');
            }
        }

        $wasPublished = $post->published;
        $nowPublished = $request->has('published');

        $post->update([
            'title'        => $request->title,
            'category'     => $request->category,
            'excerpt'      => $request->excerpt,
            'content'      => $request->content,
            'image'        => $image,
            'image_id'     => $imageId,
            'published'    => $nowPublished,
            'published_at' => ($nowPublished && !$wasPublished) ? now() : $post->published_at,
        ]);

        // Notify subscribers only when a post is newly published (not re-saved)
        if ($nowPublished && !$wasPublished) {
            $this->notifySubscribers($post);
        }

        return redirect()->route('blog.admin.index')->with('success', 'Post updated successfully.');
    }

    public function destroy($id)
    {
        BlogPost::findOrFail($id)->delete();
        return redirect()->route('blog.admin.index')->with('success', 'Post deleted.');
    }

    private function notifySubscribers(BlogPost $post): void
    {
        $subscribers = Subscriber::all();
        if ($subscribers->isEmpty()) return;

        $subject = 'New Post: ' . $post->title;
        $postUrl = route('blog.show', $post->slug);
        $excerpt = $post->excerpt ?: Str::limit(strip_tags($post->content ?? ''), 200);

        $body = "We just published a new post on the Ubuvivi Tours blog!\n\n"
              . "📰 {$post->title}\n\n"
              . ($excerpt ? "{$excerpt}\n\n" : '')
              . "Read the full post here:\n{$postUrl}";

        foreach ($subscribers as $subscriber) {
            try {
                Mail::to($subscriber->email)->send(new NewsletterMail($subject, $body));
            } catch (\Exception $e) {
                Log::warning("Blog notification failed for {$subscriber->email}: " . $e->getMessage());
            }
        }
    }
}
