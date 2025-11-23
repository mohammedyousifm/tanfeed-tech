<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ComplaintStatusChanged extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $complaint;
    public $oldStatus;
    public $newStatus;
    public $suspendedReason;

    public function __construct($complaint, $oldStatus, $newStatus, $suspendedReason = null)
    {
        $this->complaint = $complaint;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
        $this->suspendedReason = $suspendedReason;
    }


    public function build()
    {
        $oldLabel = (clone $this->complaint)
            ->fill(['status' => $this->oldStatus])
            ->status_label;

        $newLabel = (clone $this->complaint)
            ->fill(['status' => $this->newStatus])
            ->status_label;

        return $this->subject('تحديث حالة الطلب')
            ->view('emails.complaints.complaint-status')
            ->with([
                'oldLabel' => $oldLabel,
                'newLabel' => $newLabel,
                'suspendedReason' => $this->suspendedReason,
                'complaint' => $this->complaint,
            ]);
    }
}
