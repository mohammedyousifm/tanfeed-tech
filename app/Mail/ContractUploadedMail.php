<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContractUploadedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('📄 عقد جديد من التاجر ' . $this->user->name)
            ->view('emails.contract.contract-submitted')
            ->with([
                'user' => $this->user,
            ]);
    }
}
