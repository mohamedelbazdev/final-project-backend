<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'provider_id',
        'user_id'
    ];

    public function providers() {
        return $this->belongsTo( User::class, 'provider_id');
    }
}
