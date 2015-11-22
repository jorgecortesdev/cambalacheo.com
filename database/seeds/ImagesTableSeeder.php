<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $articles = \App\Article::all();

        $images_categories = [
            'abstract', 'animals', 'business', 'cats', 'city', 'food',
            'nightlife', 'fashion', 'people', 'nature', 'sports', 'technics',
            'transport'
        ];

        foreach ($articles as $article) {
            $random = array_rand($images_categories);
            for($i = 0; $i < mt_rand(1, 5); $i++) {
                $image_filename = $faker->image('/tmp', 800, 800, $images_categories[$random]);

                $mimeType = File::mimeType($image_filename);
                $size     = File::size($image_filename);

                $image = $article->images()->create([
                    'file_mime' => $mimeType,
                    'file_size' => $size,
                    'user_id'   => $article->user_id
                ]);
                Storage::disk('local')->put(
                    'articles/images' . '/' . $article->id . '/' . $image->id,
                    File::get($image_filename)
                );
            }
        }
    }
}
