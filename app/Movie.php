<?php

namespace App;

use Carbon\Carbon;
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
        'user_id',
        'category_id',
        'release_date'
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

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function visits()
    {
        return $this->morphMany(Visit::class, 'visitable');
    }

    public function getFeaturedImageAttribute()
    {
        $featured_image = $this->images()->where('featured', 1)->first();

        if ($featured_image) {
            $image = $featured_image->image;
            if (strpos($image->filename, 'https') !== false) {
                return $image->filename;
            } else {
                return asset('storage/images/' . $image->filename);
            }
        } else {
            return 'http://suiteapp.com/c.3857091/shopflow-1-03-0/img/no_image_available.jpeg';
        }
    }

    public function getYearAttribute()
    {
        return Carbon::createFromFormat('Y-m-d', $this->release_date)->year;
    }

    public function getVotesAttribute()
    {
        return count(Rating::where('movie_id', $this->id)->get());
    }

    public function getRatingAttribute()
    {
        return number_format(Rating::where('movie_id', $this->id)->avg('rating'), 1);
    }
}
