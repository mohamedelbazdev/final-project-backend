<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RateProvider extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'provider_id',
        'rate',
        'description'
    ];

    public function user()
    {
        return  $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function provider()
    {
        return  $this->belongsTo(Provider::class, 'provider_id');
    }

    
}
