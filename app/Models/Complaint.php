<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    // ✅ Mass assignable attributes
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

    /**
     * Boot method to automatically generate a unique serial number
     * when creating a new complaint record.
     *
     * The format will be: OR10000, OR10001, OR10002, ...
     */
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

    /**
     * Accessor: Get the Arabic label for the service requested.
     * Converts percentage values like "10%" into human-readable Arabic text.
     */
    public function getServiceRequestedLabelAttribute()
    {
        return match ($this->service_requested) {
            '8%' => 'تحصيل قبل المحكمة',
            '10%' => 'تحصيل بسندات تنفيذ',
            '15%' => 'إجراء قضائي أعلى من 500 ألف',
            '20%' => 'إجراء قضائي أقل من 500 ألف',
            '25%' => 'تحصيل الديون المتعثرة',
            default => $this->service_requested,
        };
    }

    /**
     * Accessor: Get the Arabic label for the complaint status.
     * Converts status keys like "pending" into Arabic display text.
     */
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

    /**
     * Accessor: Get the Arabic label for phone status.
     */
    public function getphoneStatusLabelAttribute()
    {
        return match ($this->phone_status) {
            'available'     => 'الرقم متاح',
            'not_available' => 'غير متاح',
        };
    }


    /**
     * Relationship: Complaint belongs to a User (the one who submitted it).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: Complaint can have many attachments (files, documents, etc.).
     */
    public function attachments()
    {
        return $this->hasMany(ComplaintAttachment::class);
    }

    /**
     * Relationship: Complaint can have multiple follow-up records (tracking progress).
     */
    public function followUps()
    {
        return $this->hasMany(FollowUp::class);
    }

    /**
     * Relationship: Complaint can have multiple collection records (related payments).
     */
    public function collections()
    {
        return $this->hasMany(Collection::class);
    }
}
