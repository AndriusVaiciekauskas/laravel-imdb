<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'filename',
        'featured',
        'imagable_id',
        'imagable_type',
        'user_id'
    ];
    public function imagable()
    {
        return $this->morphTo();
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', 1)->first();
    }
}
