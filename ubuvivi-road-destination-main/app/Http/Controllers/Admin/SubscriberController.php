<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\NewsletterMail;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SubscriberController extends Controller
{
    public function index()
    {
        $subscribers = Subscriber::latest()->get();
        return view('admin.subscribers.index', compact('subscribers'));
    }

    public function destroy($id)
    {
        Subscriber::findOrFail($id)->delete();
        return redirect()->route('admin.subscribers.index')->with('success', 'Subscriber removed.');
    }

    public function sendNewsletter(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'body'    => 'required|string',
        ]);

        $subscribers = Subscriber::all();

        if ($subscribers->isEmpty()) {
            return redirect()->route('admin.subscribers.index')->with('error', 'No subscribers to send to.');
        }

        $sent = 0;
        foreach ($subscribers as $subscriber) {
            try {
                Mail::to($subscriber->email)->send(new NewsletterMail($request->subject, $request->body));
                $sent++;
            } catch (\Exception $e) {
                \Log::warning("Newsletter failed for {$subscriber->email}: " . $e->getMessage());
            }
        }

        return redirect()->route('admin.subscribers.index')
            ->with('success', "Newsletter sent to {$sent} subscriber(s).");
    }
}
