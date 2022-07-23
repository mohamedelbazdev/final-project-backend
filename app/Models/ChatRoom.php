<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ChatRoom extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_1',
        'user_2'
    ];

    /**
     * @return HasMany
     */
    public function chat(): HasMany
    {
        return $this->hasMany(ChatMessage::class , 'room_id');
    }

    /**
     * @return HasMany
     */
    public function unread_chat(): HasMany
    {
        return $this->hasMany(ChatMessage::class , 'room_id')
            ->where('readed_at' , null);
    }

//    public function chat_post(): \Illuminate\Database\Eloquent\Relations\BelongsTo
//    {
//        return $this->belongsTo('App\post' , 'post_id');
//    }
    /**
     * @return BelongsTo
     */
    public function user1_data(): BelongsTo
    {
        return $this->belongsTo(User::class , 'user_1');
    }

    /**
     * @return BelongsTo
     */
    public function user2_data(): BelongsTo
    {
        return $this->belongsTo(User::class , 'user_2');
    }

    /**
     * @return HasOne
     */
    public function last_msg(): HasOne
    {
        return $this->hasOne(ChatMessage::class, 'room_id', 'id')->latest();
    }
}
