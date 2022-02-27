<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'office_id',
        'user_id',
        'status'
    ];

    public function office()
    {
        return $this->belongsTo(Office::class,'id','office_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'id','user_id');
    }
}
