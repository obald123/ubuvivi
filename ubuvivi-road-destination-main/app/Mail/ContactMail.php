<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $request)
    {
        $name = $request->get('names');
        $email = $request->get('email');
        $message = $request->get('message');
        $subject  = $request->get('subject');



        return $this->view('emails.contact')
            ->subject($subject)
            ->from('contact@ubuvivitours.com', $name)
            ->replyTo($email, $name)
            ->to(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->with([
                "mail_message" => $message,
                'name' => $name,
                'email' => $email,
            ]);
    }
}
