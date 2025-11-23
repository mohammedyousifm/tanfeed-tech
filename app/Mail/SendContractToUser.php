<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use Mpdf\Mpdf;

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
        $data = [
            'user' => $this->user,
            'contract_number' => '200/24',
        ];

        $html = view('contracts.company_contract', $data)->render();

        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'orientation' => 'P',
            'default_font' => 'dejavusans',
        ]);

        $mpdf->WriteHTML($html);

        // 🔥 حفظ الملف
        $path = public_path('contracts/user-contracts/' . $this->user->id . '.pdf');
        $mpdf->Output($path, 'F');

        // 🔥 الآن هذا رابط صالح للعرض في <a href="">
        $contractLink = asset('contracts/user-contracts/' . $this->user->id . '.pdf');

        // إرسال الإيميل
        return $this->subject('📄 عقد تنفيذ تك - الرجاء التوقيع وإعادة الرفع')
            ->view('emails.contract.send')
            ->attach($path, [
                'as' => 'عقد تنفيذ تك.pdf',
                'mime' => 'application/pdf',
            ])
            ->attach(public_path('contracts/AgencyForm.docx'), [
                'as' => 'صيغة وكالة.docx',
                'mime' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            ])
            ->with([
                'user' => $this->user,
                'uploadLink' => $this->uploadLink,
                'contractLink' => $contractLink, // 🔥 هذا الآن يعمل
            ]);
    }
}
