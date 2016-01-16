<?php

namespace Cambalacheo\Services;

use App\State;
use App\Category;
use Carbon\Carbon;
use Cambalacheo\Repositories\ArticlesRepository;
use Cambalacheo\Exceptions\NonExistentCategoryException;
use Cambalacheo\Exceptions\NonExistentLocationException;
use Cambalacheo\Exceptions\NonExistentConditionException;

class ArticlesService
{
    /**
     * Articles repository implementation
     *
     * @var ArticlesRepository
     */
    protected $articlesRepo;

    /**
     * Constructor
     *
     * @param ArticlesRepository $articlesRepo
     */
    public function __construct(ArticlesRepository $articlesRepo)
    {
        $this->articlesRepo = $articlesRepo;
    }

    /**
     * Return the most recent articles in the system with the given limit.
     *
     * @param  integer $limit
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getRecent($limit = 10)
    {
        return $this->articlesRepo->byDate(Carbon::now(), $limit);
    }

    /**
     * Return the featured articles.
     *
     * @param  integer $limit
     * @return \Illuminate\Support\Collection
     */
    public function getFeatured($limit = 8)
    {
        return $this->articlesRepo->byFeatured($limit);
    }

    /**
     * Return the articles given a specific location either id or slug.
     *
     * @param  string|integer  $state
     * @param  string|integer  $city
     * @param  integer $limit
     * @return \Illuminate\Support\Collection
     */
    public function getByLocation($state, $city, $limit = 10)
    {
        // TODO: move this into his own repository
        $conditions = ['states.id' => $state, 'cities.id' => $city];

        if (is_string($state) && is_string($city)) {
            $conditions = ['states.slug' => $state, 'cities.slug' => $city];
        }

        $location = State::join('cities', 'cities.state_id', '=', 'states.id')
                ->select('states.id as state_id', 'cities.id as city_id')
                ->where($conditions)
                ->first();

        if (! $location) throw new NonExistentLocationException;

        $articles = $this->articlesRepo->byLocation($location->state_id, $location->city_id, $limit);

        return $articles;
    }

    /**
     * Return the articles given a category either id or slug.
     *
     * @param  string|integer  $category
     * @param  integer $limit
     * @return \Illuminate\Support\Collection
     */
    public function getByCategory($category, $limit = 10)
    {
        // TODO: move this into his own repository
        $conditions['status'] = ARTICLE_STATUS_OPEN;

        is_string($category)
            ? $conditions['slug'] = $category
            : $conditions['id'] = $category;

        $category = Category::select('id')->where($conditions)->first();

        if (! $category) throw new NonExistentCategoryException;

        return $this->articlesRepo->byCategory($category->id, $limit);
    }

    /**
     * Return the articles given a condition either id or slug.
     *
     * @param  string|integer  $condition
     * @param  integer $limit
     * @return \Illuminate\Support\Collection
     */
    public function getByCondition($condition, $limit = 10)
    {
        $condition = article_condition($condition);

        if (! $condition) throw new NonExistentConditionException;

        return $this->articlesRepo->byCondition($condition['id'], $limit);
    }
}
