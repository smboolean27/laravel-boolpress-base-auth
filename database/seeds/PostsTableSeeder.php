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

            $image_name = Str::random(40) . '.jpg';

            $user = User::inRandomOrder()->first();

            $newPost = new Post();
            $newPost->user_id = $user->id;
            $newPost->title = $faker->sentence();
            $newPost->date = $faker->date(); 
            $newPost->content = $faker->text();
            //$newPost->image = 'images/' . $faker->image('public/storage/images',400,300, null, false);
            if ( $this->saveRandomImage('public/storage/images/' . $image_name) ) {
                $newPost->image = 'images/' . $image_name;
            }
            $newPost->slug = Str::slug($newPost->title, '-');
            $newPost->published = rand(0, 1);
            $newPost->save();
        }
    }

    /**
     * Generates random image; temporary fix for current issue.
     * @link https://github.com/fzaninotto/Faker/issues/1884
     *
     * @param string $absolutePath
     * @param int $width
     * @param int $height
     * @return bool
     */
    protected function saveRandomImage(string $absolutePath, int $width = 640, int $height = 480): bool
    {
        // Create a blank image:
        $im = imagecreatetruecolor($width, $height);
        // Add light background color:
        $bgColor = imagecolorallocate($im, rand(100, 255), rand(100, 255), rand(100, 255));
        imagefill($im, 0, 0, $bgColor);

        // Save the image:
        $isGenerated = imagejpeg($im, $absolutePath);

        // Free up memory:
        imagedestroy($im);

        return $isGenerated;
    }
}
