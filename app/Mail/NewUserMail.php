<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class NewUserMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {
        // ✅ Send email with PDF attachment
        return $this->markdown('emails.new-user')
            ->subject('📄شكرًا لانضمامك معنا')
            ->with([
                'user' => $this->user,
            ]);
    }
}
