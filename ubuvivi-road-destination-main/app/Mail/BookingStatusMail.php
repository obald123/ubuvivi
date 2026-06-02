<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $names;
    public bool $approved;
    public ?string $link;

    public function __construct(string $names, bool $approved, ?string $link = null)
    {
        $this->names    = $names;
        $this->approved = $approved;
        $this->link     = $link;
    }

    public function build()
    {
        $subject = $this->approved
            ? 'Your Booking Has Been Approved - Ubuvivi Tours'
            : 'Booking Update - Ubuvivi Tours';

        return $this->view('emails.booking_status')
            ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->replyTo(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->subject($subject)
            ->with([
                'names'    => $this->names,
                'approved' => $this->approved,
                'link'     => $this->link,
            ]);
    }
}
