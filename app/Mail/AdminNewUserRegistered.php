<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class AdminNewUserRegistered extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this
            ->subject('تم تسجيل تاجر جديد بنجاح: ' . $this->user->name)
            ->view('emails.admin.new_user_registered')
            ->with([
                'user' => $this->user,
            ]);
    }
}
