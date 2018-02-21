<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Movie
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Actor[] $actors
 * @property-read \App\Category $category
 * @property-read mixed $featured_image
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Image[] $images
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $category_id
 * @property int $user_id
 * @property string $year
 * @property float $rating
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Movie whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Movie whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Movie whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Movie whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Movie whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Movie whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Movie whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Movie whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Movie whereYear($value)
 */
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

    public function actors()
    {
        return $this->belongsToMany(Actor::class);
    }

    public function images()
    {
        return $this->morphMany(Imagable::class, 'imagable');
    }

    public function getFeaturedImageAttribute()
    {
        $featured_image = $this->images()->where('featured', 1)->first();

        if ($featured_image) {
            $image = $featured_image->image;
            return asset('storage/images/' . $featured_image->filename);
        } else {
            return 'http://suiteapp.com/c.3857091/shopflow-1-03-0/img/no_image_available.jpeg';
        }
    }
}
