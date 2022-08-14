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
        'hours',
        'total_amount',
        'lat',
        'lng',
        'status',
        'paid',
        'executed_at'
    ];

    public function user()
    {
        return  $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function provider()
    {
        return  $this->belongsTo(User::class, 'provider_id', 'id');
    }


    public function payment() {
        return $this->hasOne( Payment::class, 'order_id');
    }
}
