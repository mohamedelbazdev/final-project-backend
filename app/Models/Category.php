<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        // 'image'
    ];


    public function providers(){
       return $this->hasMany(Provider::class, 'category_id');
    }

    public function getList()
    {
        return $this->pluck( 'name', 'id')->toArray();
    }
}
