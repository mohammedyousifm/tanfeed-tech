<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $fillable = [
        'complaint_id',
        'serial_number',
        'collector_id',
        'collection_date',
        'amount',
        'is_read',
        'collection_receipt',
        'tanfeed_fee',
        'tanfeed_receipt',
        'collector_fee',
        'collector_fee_receipt'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($collection) {
            // ✅ Get last serial number (numeric part only)
            $lastSerial = static::max('serial_number');

            // ✅ Extract numeric part if the last serial has the prefix
            if ($lastSerial && preg_match('/\d+$/', $lastSerial, $matches)) {
                $nextNumber = intval($matches[0]) + 1;
            } else {
                $nextNumber = 10000; // start from 10000 if none exist
            }

            // ✅ Assign new formatted serial number
            $collection->serial_number = 'COL-' . $nextNumber;
        });
    }


    public function complaint()
    {
        return $this->belongsTo(Complaint::class);
    }





    public function collector()
    {
        return $this->belongsTo(User::class, 'collector_id');
    }
}
