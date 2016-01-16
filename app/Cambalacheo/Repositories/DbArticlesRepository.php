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

    /**
     * Return the articles given a specific location.
     *
     * @param  string  $state_slug
     * @param  string  $city_slug
     * @param  integer $limit
     * @return \Illuminate\Support\Collection
     */
    public function byLocation($state_id, $city_id, $limit = 10)
    {
        $conditions = [
            'users.state_id' => $state_id,
            'city_id'        => $city_id,
            'status'         => ARTICLE_STATUS_OPEN
        ];

        $relations = ['category', 'user.state', 'user.city', 'images'];

        return Article::with($relations)
                ->join('users', 'users.id', '=', 'user_id')
                ->select('articles.*')
                ->where($conditions)
                ->latest()
                ->paginate($limit);
    }

    /**
     * Return the articles given an id.
     *
     * @param  integer  $category_id
     * @param  integer $limit
     * @return \Illuminate\Support\Collection
     */
    public function byCategory($category_id, $limit = 10)
    {
        $relations = ['category', 'user.state', 'user.city', 'images'];

        return Article::with($relations)
            ->where(['category_id' => $category_id, 'status' => ARTICLE_STATUS_OPEN])
            ->latest()
            ->paginate($limit);
    }

    /**
     * Return the articles given a condition id.
     *
     * @param  integer  $condition_id
     * @param  integer $limit
     * @return \Illuminate\Support\Collection
     */
    public function byCondition($condition_id, $limit = 10)
    {
        $relations = ['category', 'user.state', 'user.city', 'images'];

        return Article::with($relations)
            ->where(['condition_id' => $condition_id, 'status' => ARTICLE_STATUS_OPEN])
            ->latest()
            ->paginate($limit);
    }
}
