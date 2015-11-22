<?php

use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Article::class, 100)->create()->each(function($article) {
            $article->user_id = mt_rand(1, 10);
            $article->save();
        });
    }
}
