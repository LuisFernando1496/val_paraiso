<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'responsable',
        'address_id',
        'bussiness_id',
    ];

    public function address()
    {
        return $this->belongsTo(Address::class,'id','address_id');
    }

    public function bussiness()
    {
        return $this->belongsTo(Business::class,'id','bussiness_id');
    }
}
