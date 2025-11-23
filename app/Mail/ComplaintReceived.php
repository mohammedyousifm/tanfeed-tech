<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ComplaintReceived extends Mailable
{
    use Queueable, SerializesModels;

    public $complaint;
    public function __construct($complaint)
    {
        $this->complaint = $complaint;
    }

    public function build()
    {
        return $this->subject('تم استلام طلب بنجاح')
            ->view('emails.complaints.complaint-received')
            ->with([
                'complaint' => $this->complaint,
            ]);
    }
}
