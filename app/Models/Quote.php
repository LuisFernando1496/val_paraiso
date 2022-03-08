<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;
    protected $fillable = [
        'folio',
        'date',
        'total',
        'discount',
        'percent',
        'method',
        'cliente',
        'client_id',
        'user_cash_id'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class,'id','client_id');
    }

    public function usercash()
    {
        return $this->belongsTo(UserHasCashRegister::class,'id','user_cash_id');
    }
}
