<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Concerns\UploadsImages;
use App\Models\BlogPost;
use Illuminate\Http\Request;
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
            $image = $this->uploadImage($request->file('image'), 'ubuvivi/blog');
        }

        BlogPost::create([
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

        return redirect()->route('blog.admin.index')->with('success', 'Post updated successfully.');
    }

    public function destroy($id)
    {
        BlogPost::findOrFail($id)->delete();
        return redirect()->route('blog.admin.index')->with('success', 'Post deleted.');
    }
}
