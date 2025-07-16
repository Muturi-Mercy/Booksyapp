<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'genre',
        'price',
        'stock_quantity',
        'cover_image',
    ];

    //to return full image url
    public function getCoverImageAttribute($value){
        return $value ? asset('storage/' . $value) : null;
    }

    //define relationship
    public function orders(){
        return $this->hasMany(Order::class); //One book can appear in many orders.
    }

    // Automatically add stock_status to JSON output
    protected $appends = ['stock_status'];
    
    //Accessor for computed stock_status
    public function getStockStatusAttribute()
    {
        return $this->stock_quantity <= 5 ? 'low' : 'available';
    }
}
