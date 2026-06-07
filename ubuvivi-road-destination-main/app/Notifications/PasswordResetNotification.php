<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class PasswordResetNotification extends ResetPassword
{
    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $this->token);
        }

        $resetUrl = url(config('app.url') . route('password.reset', $this->token, false));

        return (new MailMessage)
            ->subject('Reset Your Ubuvivi Tours Account Password')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('We received a request to reset the password for your Ubuvivi Tours & Safaris account.')
            ->line('Click the button below to create a new password:')
            ->action('Reset Password', $resetUrl)
            ->line('This password reset link will expire in 60 minutes.')
            ->line('')
            ->line('If you did not request a password reset, no action is required and your account will remain secure.')
            ->line('')
            ->line('For security reasons, never share this link with anyone. Ubuvivi staff will never ask you for this link.')
            ->line('')
            ->line('If you have any questions, please contact our support team at ubuvivitours@gmail.com')
            ->line('')
            ->salutation('Best regards,')
            ->line('Ubuvivi Tours & Safaris Team');
    }
}
