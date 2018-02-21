<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Image
 *
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $imagable
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Image featured()
 * @mixin \Eloquent
 * @property int $id
 * @property string $filename
 * @property int $imagable_id
 * @property string $imagable_type
 * @property int $user_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property int $featured
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Image whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Image whereFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Image whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Image whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Image whereImagableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Image whereImagableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Image whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Image whereUserId($value)
 */
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
        return $this->hasMany(Imagable::class);
    }
}
