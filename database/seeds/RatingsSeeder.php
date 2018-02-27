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

        for ($i = 0; $i < 10000; $i++) {
            for ($j = 0; $j < count($movies); $j = $j + mt_rand(1, 10) ){
                Rating::create([
                    'movie_id' => $movies[$j]->id,
                    'user_id' => 1,
                    'rating' => mt_rand(1, 10)
                ]);
            }
        }
    }
}
