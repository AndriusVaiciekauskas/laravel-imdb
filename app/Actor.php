<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    protected $fillable = [
      'name',
      'birthday',
      'deathday',
      'user_id'
    ];

    public function movies()
    {
        return $this->belongsToMany(Movie::class);
    }

    public function images()
    {
        return $this->morphMany('App\Image', 'imagable');
    }

    public function getFeaturedImageAttribute()
    {
        $image = $this->images()->where('featured', 1)->first();

        if ($image) {
            return asset('storage/images/' . $image->filename);
        } else {
            return 'http://suiteapp.com/c.3857091/shopflow-1-03-0/img/no_image_available.jpeg';
        }
    }
}
