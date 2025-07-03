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
}
