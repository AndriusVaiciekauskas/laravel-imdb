<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'name',
        'description',
        'year',
        'rating',
        'user_id',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
