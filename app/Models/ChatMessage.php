<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'body',
        'room_id',
        'sender_id'
    ];
}
