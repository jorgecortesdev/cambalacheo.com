<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MigrationController extends Controller
{
    public function categories_slug()
    {
        $categories = \App\Category::all();
        foreach ($categories as $category) {
            $name = str_replace('/', ' ', $category->name);
            $category->slug = str_slug($name);
            $category->save();
        }

        echo "Done";
    }

    public function location_slug()
    {
        $states = \App\State::all();
        foreach ($states as $state) {
            $state->slug = str_slug($state->name);
            $state->save();
        }

        $cities = \App\City::all();
        foreach ($cities as $city) {
            $city->slug = str_slug($city->name);

            $index = 1;
            while (\App\City::whereSlug($city->slug)->exists()) {
                $city->slug = str_slug($city->name) . '-' . $index++;
            }
            $city->save();
        }

        echo 'Done';
    }

    public function article_slug()
    {
        $articles = \App\Article::all();

        foreach ($articles as $article) {
            $article->slug = str_slug($article->title);

            $index = 1;
            while (\App\Article::whereSlug($article->slug)->exists()) {
                $article->slug = str_slug($article->title) . '-' . $index++;
            }
            $article->save();
        }

        echo 'Done';
    }
}
