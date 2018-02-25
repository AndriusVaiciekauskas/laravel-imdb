<?php

use App\Actor;
use App\Movie;
use Illuminate\Database\Seeder;

class ActorMovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $movies = Movie::all();
        $actors = Actor::all();

        $j = 1;
        foreach ($movies as $movie) {
            for ($i = $j; $i <= (10 + $j); $i++) {
                DB::table('actor_movie')->insert([
                    'actor_id' => $actors[$i]->id,
                    'movie_id' => $movie->id
                ]);
            }
            $j += 10;
        }

    }
}
