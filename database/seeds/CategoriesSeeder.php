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

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        // genres
        $client = new Client();
        $res = $client->request('GET', 'https://api.themoviedb.org/3/genre/movie/list?api_key=8cf0aeb07b445e3a86becf98f0e14a9c');
        $result = $res->getBody()->getContents();
        $r = json_decode($result);
        $categories = $r->genres;

        foreach ($categories as $category) {
            Category::create([
                'name' => $category->name,
                'description' => $faker->sentence,
                'user_id' => 1
            ]);

            $category_id[] = $category->id;
        }

        // movies
        $i = 1;
        foreach ($category_id as $id) {
            $client1 = new Client();
            $res1 = $client1->request('GET', 'https://api.themoviedb.org/3/genre/'.$id.'/movies?api_key=8cf0aeb07b445e3a86becf98f0e14a9c');
            $result1 = $res1->getBody()->getContents();
            $r1 = json_decode($result1);
            $movies = $r1->results;
            foreach ($movies as $movie) {
                if (!in_array($movie->title, $this->movies)) {
                    $this->movies[] = $movie->title;

                    $mov = Movie::create([
                        'name' => $movie->title,
                        'description' => $movie->overview,
                        'year' => Carbon::createFromFormat('Y-m-d', $movie->release_date)->year,
                        'user_id' => 1,
                        'category_id' => $i,
                    ]);

                    // add to images
                    if ($movie->poster_path !== null) {
                        $file = Image::create([
                            'filename' => 'https://image.tmdb.org/t/p/w500' . $movie->poster_path,
                            'user_id' => 1,
                        ]);

                        // add to imagables
                        $mov->images()->create(['image_id' => $file->id, 'featured' => 1]);
                    }

                    $this->movie_id[] = $movie->id;
                }
            }
            $i++;
        }

        $movies = array_unique($this->movie_id);

        // actors
        $j = 1;
        foreach ($movies as $movie) {
            $client2 = new Client();
            $res2 = $client2->request('GET', 'https://api.themoviedb.org/3/movie/'.$movie.'/credits?api_key=8cf0aeb07b445e3a86becf98f0e14a9c');
            $result2 = $res2->getBody()->getContents();
            $a = json_decode($result2);
            $actors = $a->cast;

            foreach ($actors as $actor) {
                if (!in_array($actor->name, $this->actors)) {
                    $this->actors[] = $actor->name;

                    $act = Actor::create([
                        'name' => $actor->name,
                        'birthday' => null,
                        'user_id' => 1,
                    ]);

                    if ($actor->profile_path !== null) {
                        $img = Image::create([
                            'filename' => 'https://image.tmdb.org/t/p/w500' . $actor->profile_path,
                            'user_id' => 1,
                        ]);

                        // add to imagables
                        $act->images()->create(['image_id' => $img->id, 'featured' => 1]);
                    }

                $act->movies()->sync($j);
                }
            }
            $j++;
        }
    }
}
