<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeSubscriberMail extends Mailable
{
    use Queueable, SerializesModels;

    public function build()
    {
        return $this->view('emails.welcome_subscriber')
            ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->replyTo(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->subject('Welcome to Ubuvivi Tours Newsletter!');
    }
}
