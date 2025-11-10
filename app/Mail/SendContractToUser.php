<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class SendContractToUser extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $uploadLink;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, string $uploadLink)
    {
        $this->user = $user;
        $this->uploadLink = $uploadLink;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('📄 عقد تنفيذ تك - الرجاء التوقيع وإعادة الرفع')
            ->view('emails.contract.send')
            ->attach(public_path('contracts/contract.pdf'), [
                'as' => 'عقد تنفيذ تك.pdf',
                'mime' => 'application/pdf',
            ])
            ->attach(public_path('contracts/instructions.pdf'), [
                'as' => 'صيغة وكالة.pdf',
                'mime' => 'application/pdf',
            ])
            ->with([
                'user' => $this->user,
                'uploadLink' => $this->uploadLink,
            ]);
    }
}
