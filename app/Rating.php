<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    public $timestamps;
    protected $fillable = [
        'movie_id',
        'user_id',
        'rating'
    ];

    public function movies()
    {
        return $this->belongsTo(Movie::class);
    }

    public function actors()
    {
        return $this->belongsTo(Actor::class);
    }
}
