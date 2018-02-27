<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Andrius',
            'email' => 'vaiciekauskas@gmail.com',
            'password' => bcrypt('andrius'),
            'role' => 'Admin'
        ]);
    }
}
