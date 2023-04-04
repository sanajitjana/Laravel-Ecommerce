<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class billing_info extends Model
{
    use HasFactory;

    protected $fillable = [

        'summary',
        'billing_address',
        'payment_details',
        'customer_id'
    ];
}
