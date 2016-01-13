<?php

namespace Cambalacheo;

use App;
use App\Article;
use App\Category;

class SitemapService
{
    /**
     * Build the articles sitemap.
     *
     * @return string
     */
    public function articles()
    {
        $sitemap = App::make("sitemap");
        $sitemap->setCache(
           $this->cacheKey('articles'),
           3600
        );

        if (!$sitemap->isCached()) {
            $articles = Article::active()->latest()->get();

            foreach ($articles as $article) {
                $sitemap->add(
                    $article->present()->url, // url
                    $article->updated_at, // date
                    '0.5', // priority
                    'monthly' // freq
                );
            }
        }

        return $sitemap->render('xml');
    }

    /**
     * Build the cataegories sitemap.
     *
     * @return string
     */
    public function categories()
    {
        $sitemap = App::make("sitemap");
        $sitemap->setCache(
           $this->cacheKey('categories'),
           3600
       );

        if (!$sitemap->isCached()) {
            $categories = Category::active()->latest()->get();
            foreach ($categories as $category) {
                $sitemap->add(
                    $category->present()->url,
                    null,
                    '0.5',
                    'hourly'
                );
            }
        }

        return $sitemap->render('xml');
    }

    /**
     * Return the cache key
     *
     * @param  string $name
     *
     * @return string
     */
    private function cacheKey($name)
    {
        return 'laravel.sitemap.' . $name;
    }
}
