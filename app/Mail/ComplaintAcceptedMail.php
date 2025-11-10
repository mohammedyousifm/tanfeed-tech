<?php

namespace App\Mail;

use App\Models\Complaint;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ComplaintAcceptedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $complaint;

    public function __construct(Complaint $complaint)
    {
        $this->complaint = $complaint;
    }

    public function build()
    {
        return $this->subject('تم قبول طلبك - تنفيذ تك')
            ->markdown('emails.complaints.accepted')
            ->with(['complaint' => $this->complaint]);
    }
}
