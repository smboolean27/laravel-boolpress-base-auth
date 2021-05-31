<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 10; $i++) {

            $user = User::inRandomOrder()->first();

            $newPost = new Post();
            $newPost->user_id = $user->id;
            $newPost->title = $faker->sentence();
            $newPost->date = $faker->date(); 
            $newPost->content = $faker->text();
            $newPost->image = 'images/' . $faker->image('public/storage/images',400,300, null, false);
            $newPost->slug = Str::slug($newPost->title, '-');
            $newPost->published = rand(0, 1);
            $newPost->save();
        }
    }
}
