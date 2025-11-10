<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuspendedComplaint extends Model
{
    use HasFactory;

    protected $fillable = ['complaint_id', 'reason'];

    public function complaint()
    {
        return $this->belongsTo(Complaint::class);
    }
}
