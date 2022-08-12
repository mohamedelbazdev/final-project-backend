<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable {

    use HasApiTokens, HasFactory, Notifiable;

    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = [
        'name',
        'email',
        'password',
        'lat',
        'lng',
        'role_id',
        'image',
        'mobile',
        'status'
    ];

    /**
    * The attributes that should be hidden for serialization.
    *
    * @var array<int, string>
    */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
    * The attributes that should be cast.
    *
    * @var array<string, string>
    */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
    * @param $query
    * @return void
    */

    public function scopeAdmin( $query ) {
        $query->where( 'role_id', 1 );
    }

    /**
    * @param $query
    * @return void
    */

    public function scopeProvider( $query ) {
        $query->where( 'role_id', 2 );
    }

    /**
    * @param $query
    * @return void
    */

    public function scopeUser( $query ) {
        $query->where( 'role_id', 3 );
    }

    public function providers() {
        return $this->hasOne( Provider::class, 'user_id');
    }


    /**
     * Get the user's full path url.
     *
     * @param  $value
     * @return
     */
    public function getImageAttribute($value)
    {
        if($value) return url($value);

        return $value;
    }

    public function rateprovider()
    {
        return $this->hasMany(RateProvider::class, 'user_id');
    }

    public function order()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    public function favorite(){
        return $this->hasMany(Favorite::class, 'user_id')->whereUserId(Auth::id());
    }

    
    public function isFavorite(){
        return $this->hasMany(Favorite::class, 'provider_id')->whereUserId(Auth::id());
    }
    
}
