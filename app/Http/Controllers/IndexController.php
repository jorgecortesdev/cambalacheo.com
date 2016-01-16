<?php

namespace App\Http\Controllers;

use Cambalacheo\Facades\Articles;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{

    public function index()
    {
        $articles = Articles::getRecent();
        $featured = Articles::getFeatured();

        return view('index.index', compact('articles', 'featured'));
    }

    public function location($state_slug, $city_slug)
    {
        try {
            $articles = Articles::getByLocation($state_slug, $city_slug);

            return view('index.location', compact('articles'));

        } catch (\Cambalacheo\Exceptions\NonExistentLocationException $e) {

            flash()->error('Esa ubicación no existe :(');

            return redirect()->route('index');
        }
    }

    public function category($category_slug)
    {
        try {
            $articles = Articles::getByCategory($category_slug);

            return view('index.category', compact('articles'));

        } catch (\Cambalacheo\Exceptions\NonExistentCategoryException $e) {

            flash()->error('Esa categoría no existe :(');

            return redirect()->route('index');
        }
    }

    public function condition($condition_slug)
    {
        try {
            $articles = Articles::getByCondition($condition_slug);

            return view('index.condition', compact('articles'));

        } catch (\Cambalacheo\Exceptions\NonExistentConditionException $e) {

            flash()->error('Esa condición no existe :(');

            return redirect()->route('index');
        }
    }
}
