<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FollowUp extends Model
{
    protected $fillable = ['complaint_id', 'collector_id', 'note', 'method', 'follow_date'];

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
}
