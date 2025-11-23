<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MerchantStatusChangedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $oldLabel;
    public $newLabel;
    public $text;

    public function __construct($user, $oldLabel, $newLabel, $text)
    {
        $this->user = $user;
        $this->oldLabel = $oldLabel;
        $this->newLabel = $newLabel;
        $this->text = $text;
    }

    public function build()
    {
        return $this->subject('تحديث حالة حسابك')
            ->view('emails.merchant.MerchantStatusChanged');
    }
}
