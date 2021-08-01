<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'product_id', 
        'stars', 
        'review',
    ];

    public function customer(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function humantFormattedDate(){
        return Carbon::createFromTimeStamp(strtotime($this->created_at)) ->diffForHumans();
    }
}
