<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        "order_id",
        "company_name",
        "company_id",
        "date_of_shipment"
    ];
}
