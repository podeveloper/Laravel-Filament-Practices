<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'voucher_id',
        'user_id',
        'product_id',
        'subtotal',
        'taxes',
        'total',
    ];
}
