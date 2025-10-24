<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\URL;

class CustomVerifyEmail extends VerifyEmail
{
    /**
     * Build the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->view('emails.verify-email', [
                'user' => $notifiable,
                'verificationUrl' => $verificationUrl,
            ])
            ->subject('تأكيد البريد الإلكتروني - تنفيذ تك');
    }
}
