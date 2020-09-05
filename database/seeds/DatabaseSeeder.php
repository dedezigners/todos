<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        factory(App\User::class, 20)->create();
        factory(App\Category::class, 25)->create();
        factory(App\Question::class, 100)->create();
        factory(App\Reply::class, 250)->create()->each(function($reply){
            return $reply->likes()->saveMany(factory(App\Like::class, rand(2, 10))->make());
        });
    }
}
