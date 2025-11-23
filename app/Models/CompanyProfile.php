<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_name',
        'establishment_number',
        'business_type',
        'city',
        'district',
        'manager_name',
        'phone_1',
        'phone_2',
        'company_email',
        'national_id',
        'owner_id_pdf',
        'commercial_record_pdf',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
