<?php

namespace App\Http\Controllers;

use App;
use App\Article;
use App\Category;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SitemapController extends Controller
{
    public function articles()
    {
        $sitemap = App::make("sitemap");
        $sitemap->setCache('laravel.sitemap.articles', 3600);

        if (!$sitemap->isCached()) {
            $articles = Article::active()->latest()->get();
            foreach ($articles as $article) {
                $sitemap->add(
                    url("articulo/{$article->slug}"),
                    $article->updated_at,
                    '0.5',
                    'monthly'
                );
            }
        }

        return $sitemap->render('xml');
    }

    public function categories()
    {
        $sitemap = App::make("sitemap");
        $sitemap->setCache('laravel.sitemap.categories', 3600);

        if (!$sitemap->isCached()) {
            $categories = Category::active()->latest()->get();
            foreach ($categories as $category) {
                $sitemap->add(
                    url("categoria/{$category->slug}"),
                    null,
                    '0.5',
                    'hourly'
                );
            }
        }

        return $sitemap->render('xml');
    }
}
