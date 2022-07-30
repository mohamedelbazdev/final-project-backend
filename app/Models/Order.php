<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'provider_id',
        'sender_id',
        'received_id',
        'description',
        'amount',
        'lat',
        'lng',
        'status',
        'executed_at'
    ];
}
