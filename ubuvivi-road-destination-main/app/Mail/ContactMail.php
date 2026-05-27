<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(private array $data) {}

    public function build()
    {
        return $this->view('emails.contact')
            ->subject($this->data['subject'])
            ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->replyTo($this->data['email'], $this->data['name'])
            ->to(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->with([
                'mail_message' => $this->data['message'],
                'name'         => $this->data['name'],
                'email'        => $this->data['email'],
            ]);
    }
}
