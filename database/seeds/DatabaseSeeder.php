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
        factory(App\User::class, 10)->create();
        factory(App\Category::class, 10)->create();
        factory(App\Question::class, 25)->create();
        factory(App\Reply::class, 50)->create()->each(function($reply){
            return $reply->likes()->saveMany(factory(App\Like::class, 10)->make());
        });
    }
}
