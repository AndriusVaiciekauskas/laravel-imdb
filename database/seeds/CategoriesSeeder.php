<?php

use App\Category;
use GuzzleHttp\Client;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
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
        }
    }
}
