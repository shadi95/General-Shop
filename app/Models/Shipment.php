<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'payment_id', 
        'order_id', 
        'status', 
        'shipment_date', 
    ];
}
