<?php

use App\Category;
use App\Image;
use App\Movie;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Database\Seeder;

class MoviesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::all();


        for ($i = 1; $i <= count($categories); $i++) {
            // movies
            $client = new Client();
            $res = $client->request('GET', 'https://api.themoviedb.org/3/movie/popular?api_key=8cf0aeb07b445e3a86becf98f0e14a9c&page='.$i);
            $result = $res->getBody()->getContents();
            $r = json_decode($result);
            $movies = $r->results;

            foreach ($movies as $movie) {
                $mov = Movie::create([
                    'name' => $movie->title,
                    'description' => $movie->overview,
                    'year' => Carbon::createFromFormat('Y-m-d', $movie->release_date)->year,
                    'user_id' => 1,
                    'category_id' => $i,
                ]);

                // add to images
                $file = Image::create([
                    'filename' => 'https://image.tmdb.org/t/p/w500' . $movie->poster_path,
                    'user_id' => 1,
                ]);

                // add to imagables
                $mov->images()->create(['image_id' => $file->id, 'featured' => 1]);
            }
        }
    }
}
