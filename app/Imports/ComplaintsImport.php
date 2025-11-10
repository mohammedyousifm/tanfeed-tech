<?php

namespace App\Imports;

use App\Models\Complaint;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ComplaintsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Complaint([
            'user_id'                  => Auth::id(),
            'collector_ids'            => null,
            'client_name'              => $row['client_name'] ?? null,
            'client_city'              => $row['client_city'] ?? null,
            'client_national_id'       => $row['client_national_id'] ?? null,
            'phone_number1'            => $row['phone_number1'] ?? null,
            'phone_number2'            => $row['phone_number2'] ?? null,
            'activity_type'            => $row['activity_type'] ?? null,
            'manager_name'             => $row['manager_name'] ?? null,
            'manager_id'               => $row['manager_id'] ?? null,
            'commercial_name'          => $row['commercial_name'] ?? null,
            'commercial_record_number' => $row['commercial_record_number'] ?? null,
            'contract_number'          => $row['contract_number'] ?? null,
            'amount_requested'         => $row['amount_requested'] ?? 0,
            'amount_paid'              => $row['amount_paid'] ?? 0,
            'amount_remaining'         => $row['amount_remaining'] ?? 0,
            'service_requested'        => $row['service_requested'] ?? null,
            'complaint_notes'          => $row['complaint_notes'] ?? null,
            'contract_attachments'     => $row['contract_attachments'] ?? null,
        ]);
    }
}
