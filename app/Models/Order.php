<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable =[
        'user_id', 
        'book_id',
        'quantity',
        'status',
        'payment_status'
    ];
    
    //define relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class); //Each order belongs to one user and one book.
    }
}
