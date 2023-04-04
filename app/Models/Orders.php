<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_of_order_placement',
        'product_data',
        'ship_via',
        'pay',
        'shipper_id',
        'customer_id'

    ];
}
