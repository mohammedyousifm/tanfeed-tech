<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FollowUp extends Model
{
    protected $fillable = ['complaint_id', 'serial_number', 'lawyer_comment', 'collector_id', 'note', 'method', 'is_read',  'follow_date'];

    public function complaint()
    {
        return $this->belongsTo(Complaint::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function collector()
    {
        return $this->belongsTo(User::class, 'collector_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($followUp) {
            // ✅ Get the last serial_number
            $lastSerial = static::max('serial_number');

            if ($lastSerial && preg_match('/\d+$/', $lastSerial, $matches)) {
                $nextNumber = intval($matches[0]) + 1;
            } else {
                $nextNumber = 10000;
            }


            $followUp->serial_number = 'FU' . $nextNumber;
        });
    }
}
