<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorHasProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'vendor_id',
        'product_id'
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class,'id','vendor_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'id','product_id');
    }
}
