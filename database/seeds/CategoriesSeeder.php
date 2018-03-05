<?php

use App\Actor;
use App\Category;
use App\Image;
use App\Movie;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    public $category_id = [];
    public $movie_id = [];
    public $movies = [];
    public $actors = [];
    public $act;

    public function getData($url)
    {
        $client = new Client();
        $res = $client->request('GET', $url);
        $result = $res->getBody()->getContents();
        return json_decode($result);
    }

    public function addMovieImages($movie, $mov)
    {
        $file = Image::create([
            'filename' => 'https://image.tmdb.org/t/p/w500' . $movie->poster_path,
            'user_id' => 1,
        ]);

        // add to imagables
        $mov->images()->create(['image_id' => $file->id, 'featured' => 1]);
    }

    public function addActorImages($actor)
    {
        $img = Image::create([
            'filename' => 'https://image.tmdb.org/t/p/w500' . $actor->profile_path,
            'user_id' => 1,
        ]);

        // add to imagables
        $this->act->images()->create(['image_id' => $img->id, 'featured' => 1]);
    }

    public function seedCategories()
    {
        $faker = Faker\Factory::create();

        $res1 = $this->getData('https://api.themoviedb.org/3/genre/movie/list?api_key=8cf0aeb07b445e3a86becf98f0e14a9c');
        $categories = $res1->genres;

        foreach ($categories as $category) {
            Category::create([
                'name' => $category->name,
                'description' => $faker->sentence,
                'user_id' => 1
            ]);

            $this->category_id[] = $category->id;
        }
    }

    public function seedMovies()
    {
        for ($i = 0; $i < count($this->category_id); $i++) {
            $res2 = $this->getData('https://api.themoviedb.org/3/genre/'.$this->category_id[$i].'/movies?api_key=8cf0aeb07b445e3a86becf98f0e14a9c');
            $movies = $res2->results;

            foreach ($movies as $movie) {
                if (!in_array($movie->title, $this->movies)) {
                    $this->movies[] = $movie->title;

                    $mov = Movie::create([
                        'name' => $movie->title,
                        'description' => $movie->overview,
                        'release_date' => $movie->release_date,
                        'user_id' => 1,
                        'category_id' => $i+1,
                    ]);

                    // add to images
                    if ($movie->poster_path !== null) {
                        $this->addMovieImages($movie, $mov);
                    }

                    $this->movie_id[] = $movie->id;
                }
            }
        }
    }

    public function seedActors()
    {
        for ($j = 0; $j < count($this->movie_id); $j++) {
            $res3 = $this->getData('https://api.themoviedb.org/3/movie/'.$this->movie_id[$j].'/credits?api_key=8cf0aeb07b445e3a86becf98f0e14a9c');
            $actors = $res3->cast;

            foreach ($actors as $actor) {
                if (!in_array($actor->name, $this->actors)) {
                    $a = $this->getData('https://api.themoviedb.org/3/person/'.$actor->id.'?api_key=8cf0aeb07b445e3a86becf98f0e14a9c');

                    if (!isset($a->birthday) || count(explode('-', $a->birthday)) != 3) {
                        $bday = null;
                    } else {
                        $bday = $a->birthday;
                    }

                    $this->actors[] = $actor->name;

                    $this->act = Actor::create([
                        'name' => $actor->name,
                        'birthday' => $bday,
                        'user_id' => 1,
                    ]);

                    if ($actor->profile_path !== null) {
                        $this->addActorImages($actor);
                    }

                    $this->act->movies()->sync($j+1);
                } else {
                    $this->act->movies()->sync($j+1);
                }
            }
        }
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seedCategories();
        $this->seedMovies();
        $this->seedActors();
    }
}
