<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'serial_number',
        'user_id',
        'collector_ids',
        'client_name',
        'client_national_id',
        'phone_number1',
        'phone_number2',
        'commercial_name',
        'commercial_record_number',
        'contract_number',
        'amount_requested',
        'amount_paid',
        'amount_remaining',
        'service_requested',
        'contract_attachments',
        'status',
    ];

    protected $casts = [
        'collector_ids' => 'array', // automatically handle JSON array
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function followUps()
    {
        return $this->hasMany(FollowUp::class);
    }

    public function collections()
    {
        return $this->hasMany(Collection::class);
    }


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($complaint) {
            $lastSerial = Complaint::max('serial_number');
            $complaint->serial_number = $lastSerial ? $lastSerial + 1 : 10000;
        });
    }

    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            'pending'     => 'قيد المراجعة',
            'in_progress' => 'قيد التنفيذ',
            'completed'   => 'مكتمل',
            'cancelled'   => 'ملغي',
            'accepted' => 'مقبول',
            'suspended' => 'معلق',
            default       => 'غير محدد',
        };
    }



    // public function collectors()
    // {
    //     return $this->belongsToMany(User::class, 'collector_complaint', 'complaint_id', 'collector_id');
    // }
}
