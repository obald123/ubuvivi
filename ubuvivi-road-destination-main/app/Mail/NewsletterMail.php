<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsletterMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $newsletterSubject;
    public string $newsletterBody;

    public function __construct(string $subject, string $body)
    {
        $this->newsletterSubject = $subject;
        $this->newsletterBody    = $body;
    }

    public function build()
    {
        return $this->view('emails.newsletter')
            ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->replyTo(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->subject($this->newsletterSubject)
            ->with([
                'body'    => $this->newsletterBody,
                'subject' => $this->newsletterSubject,
            ]);
    }
}
