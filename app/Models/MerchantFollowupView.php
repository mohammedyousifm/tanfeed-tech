<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantFollowupView extends Model
{
    use HasFactory;

    protected $fillable = [
        'merchant_id',
        'follow_up_id',
    ];

    public function merchant()
    {
        return $this->belongsTo(User::class, 'merchant_id');
    }

    public function followUp()
    {
        return $this->belongsTo(FollowUp::class, 'follow_up_id');
    }
}
