<?php

namespace Cambalacheo\Repositories;

use App\Article;
use Carbon\Carbon;
use Cambalacheo\Repositories\ArticlesRepository;

class DbArticlesRepository implements ArticlesRepository
{
    /**
     * Return the most recent articles in the system with the given limit.
     *
     * @param  integer $limit
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function byDate(Carbon $date = null, $limit = 10)
    {
        if (! $date) $date = Carbon::now();

        $relations = ['category', 'user.state', 'user.city', 'images'];

        $articles = Article::with($relations)
            ->where('status', ARTICLE_STATUS_OPEN)
            ->whereDate('created_at', '<=', $date->toDateString())
            ->latest()
            ->paginate($limit);

        return $articles;
    }

    /**
     * Return the featured articles.
     *
     * @param  integer $limit
     * @return \Illuminate\Support\Collection
     */
    public function byFeatured($limit = 8)
    {
        return Article::with('images')
            ->where('status', ARTICLE_STATUS_OPEN)
            ->orderBy(\DB::raw('RAND()'))
            ->take($limit)
            ->get();
    }
}
