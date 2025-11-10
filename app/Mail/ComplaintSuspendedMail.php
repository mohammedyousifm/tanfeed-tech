<?php

namespace App\Mail;

use App\Models\Complaint;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ComplaintSuspendedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $complaint;
    public $reason;

    public function __construct(Complaint $complaint, $reason)
    {
        $this->complaint = $complaint;
        $this->reason = $reason;
    }

    public function build()
    {
        return $this->subject('تم تعليق طلبك - تنفيذ تك')
            ->markdown('emails.complaints.suspended')
            ->with([
                'complaint' => $this->complaint,
                'reason' => $this->reason,
            ]);
    }
}
