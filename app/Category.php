<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'description',
        'user_id'
    ];

    public function movies()
    {
        return $this->hasMany('App\Movie');
    }
}
