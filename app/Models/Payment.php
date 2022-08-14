<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'amount',
        'currency',
        'source',
        'description',
        'strip_id'
    ];



    public function user()
    {
        return  $this->belongsTo(User::class, 'user_id', 'id');
    }


    
    public function order()
    {
        return  $this->belongsTo(Order::class, 'order_id', 'id');
    }
}
