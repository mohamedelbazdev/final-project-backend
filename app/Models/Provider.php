<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'price',
        'description',
        'status',
        'category_id'
    ];

    public function categories(){
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }

    
}
