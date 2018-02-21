<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Actor
 *
 * @property-read mixed $featured_image
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Image[] $images
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Movie[] $movies
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $birthday
 * @property string|null $deathday
 * @property int|null $user_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Actor whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Actor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Actor whereDeathday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Actor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Actor whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Actor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Actor whereUserId($value)
 */
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
