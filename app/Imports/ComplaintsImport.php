<?php

namespace App\Imports;

use App\Models\Complaint;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');

class ComplaintsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Complaint([
            'user_id'                  => Auth::id(),
            'collector_ids'            => null,

            'client_name'              => $row['اسم العميل'] ?? null,
            'client_city'              => $row['مدينة العميل'] ?? null,
            'client_national_id'       => $row['رقم هوية العميل'] ?? null,

            'phone_number1'            => $row['رقم الهاتف1'] ?? null,
            'phone_number2'            => $row['رقم الهاتف2'] ?? null,

            'activity_type'            => $row['نوع النشاط'] ?? null,
            'manager_name'             => $row['اسم المدير'] ?? null,
            'manager_id'               => $row['رقم المدير'] ?? null,

            'commercial_name'          => $row['الاسم التجاري'] ?? null,
            'commercial_record_number' => $row['رقم السجل التجاري'] ?? null,
            'contract_number'          => $row['رقم العقد'] ?? null,

            'amount_requested'         => $row['المبلغ المطلوب'] ?? 0,
            'amount_paid'              => $row['المبلغ المدفوع'] ?? 0,
            'amount_remaining'         => $row['المبلغ المتبقي'] ?? 0,

            'complaint_notes'          => $row['ملاحظات العقد'] ?? null,
        ]);
    }
}
