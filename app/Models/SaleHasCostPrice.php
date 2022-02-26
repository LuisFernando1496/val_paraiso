<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleHasCostPrice extends Model
{
    use HasFactory;
    protected $fillable = [
        'sale_id',
        'cost_price_id',
        'quantity',
        'discount',
        'percent'
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class,'id','sale_id');
    }

    public function costprice()
    {
        return $this->belongsTo(CostPrice::class,'id','cost_price_id');
    }
}
