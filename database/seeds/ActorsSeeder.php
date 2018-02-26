<?php

use App\Actor;
use App\Image;
use App\Movie;
use GuzzleHttp\Client;
use Illuminate\Database\Seeder;

class ActorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 200; $i++) {
            // actors
            $client = new Client();
            $res = $client->request('GET', 'https://api.themoviedb.org/3/person/popular?api_key=8cf0aeb07b445e3a86becf98f0e14a9c&page='.$i);
            $result = $res->getBody()->getContents();
            $r = json_decode($result);
            $actors = $r->results;

            foreach ($actors as $actor) {
                // actor birthday
                $client1 = new Client();
                $res = $client1->request('GET', 'https://api.themoviedb.org/3/person/'.$actor->id.'?api_key=8cf0aeb07b445e3a86becf98f0e14a9c');
                $result = $res->getBody()->getContents();
                $a = json_decode($result);
                if (!isset($a->birthday)) {
                    $bday = null;
                } else {
                    $bday = $a->birthday;
                }

                // add to actors
                $person = Actor::create([
                    'name' => $actor->name,
                    'birthday' => $bday,
                    'user_id' => 1,
                ]);

                // add to images
                $file = Image::create([
                   'filename' => 'https://image.tmdb.org/t/p/w500' . $actor->profile_path,
                    'user_id' => 1,
                ]);

                // add to imagables
                $person->images()->create(['image_id' => $file->id, 'featured' => 1]);
            }
        }
    }
}
