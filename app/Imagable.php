<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imagable extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'image_id',
        'imagable_id',
        'imagable_type'
    ];

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    public function related()
    {
        return $this->morphTo();
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', 1);
    }
}
