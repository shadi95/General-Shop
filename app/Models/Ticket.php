<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'order_id',
        'title',
        'message',
        'status',
        'ticket_type_id',
    ];

    public function ticketType(){
        return $this->belongsTo(TicketType::class);
    }
}
