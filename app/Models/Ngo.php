<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NGO extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'mobile_number', 'email', 'certificate_id'];
}
