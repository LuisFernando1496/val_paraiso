<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partners extends Model
{
    use HasFactory;

    protected $fillable = [
        'num_socio',
        'name',
        'last_name',
        'second_lastname',
        'age',
        'phone',
        'phone_emergency',
        'email',
        'certification',
        'photo',
        'sign',
        'date'
    ];
}
