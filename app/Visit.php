<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'visit_count',
        'visitable_id',
        'visitable_type'
    ];

    public function related()
    {
        return $this->morphTo('visitable');
    }
}
