<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantCollectionView extends Model
{
    use HasFactory;

    protected $fillable = [
        'merchant_id',
        'collection_id',
    ];

    public function merchant()
    {
        return $this->belongsTo(User::class, 'merchant_id');
    }

    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }
}
