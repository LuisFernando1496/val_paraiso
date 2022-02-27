<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'amount',
        'remaining',
        'sale_has_credit_id'
    ];

    public function salecredit()
    {
        return $this->belongsTo(SaleHasCredit::class);
    }
}
