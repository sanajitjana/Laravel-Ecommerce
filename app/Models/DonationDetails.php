<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonationDetails extends Model
{
    use HasFactory;

    protected $fillable = ['receiver_name', 'date_of_donation', 'customer_id', 'ngo_id'];
}
