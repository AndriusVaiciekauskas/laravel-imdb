<?php

use App\Movie;
use App\Rating;
use Illuminate\Database\Seeder;

class RatingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $movies = Movie::all();

        for ($i = 0; $i < 1000; $i++) {
            foreach ($movies as $movie) {
                Rating::create([
                    'movie_id' => $movie->id,
                    'user_id' => 1,
                    'rating' => mt_rand(1, 10)
                ]);
            }
        }
    }
}
