<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $fillable = [
        'complaint_id',
        'collector_id',
        'collection_date',
        'amount',
        'collection_receipt',
        'tanfeed_fee',
        'tanfeed_receipt'
    ];

    public function complaint()
    {
        return $this->belongsTo(Complaint::class);
    }


    public function collector()
    {
        return $this->belongsTo(User::class, 'collector_id');
    }
}
