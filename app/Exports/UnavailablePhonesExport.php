<?php

namespace App\Exports;

use App\Models\Complaint;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UnavailablePhonesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Complaint::select('serial_number', 'client_national_id', 'client_name', 'phone_number1', 'phone_number2')
            ->where('phone_status', 'not_available')
            ->get();
    }

    public function headings(): array
    {
        return ['رقم الطلب', 'الهوية الوطنية', 'اسم العميل',  'رقم الهاتف 1', 'رقم الهاتف 2'];
    }
}
