<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'description', 
        'unit', 
        'price', 
        'total', 
        'image_id',
    ];

    public function images(){
        return $this->hasMany(Image::class);
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
}
