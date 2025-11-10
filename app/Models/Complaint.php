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
        'collector_id',
        'client_name',
        'client_city',
        'client_national_id',
        'phone_number1',
        'phone_number2',
        'phone_status',
        'activity_type',
        'manager_name',
        'manager_id',
        'commercial_name',
        'commercial_record_number',
        'contract_number',
        'amount_requested',
        'amount_paid',
        'amount_remaining',
        'service_requested',
        'complaint_notes',
        'status',
    ];


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($complaint) {
            $lastSerial = Complaint::where('serial_number', 'like', 'OR%')
                ->orderByDesc('id')
                ->value('serial_number');

            if ($lastSerial && preg_match('/OR(\d+)/', $lastSerial, $matches)) {
                $nextNumber = intval($matches[1]) + 1;
            } else {
                $nextNumber = 10000;
            }

            $complaint->serial_number = 'OR' . $nextNumber;
        });
    }


    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function attachments()
    {
        return $this->hasMany(ComplaintAttachment::class);
    }


    public function followUps()
    {
        return $this->hasMany(FollowUp::class);
    }

    public function collections()
    {
        return $this->hasMany(Collection::class);
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

    public function getphoneStatusLabelAttribute()
    {
        return match ($this->phone_status) {
            'available'     => 'الرقم متاح',
            'not_available' => 'غير متاح',
        };
    }
}
