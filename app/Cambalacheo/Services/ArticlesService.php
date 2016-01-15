<?php

namespace Cambalacheo\Services;

use Carbon\Carbon;
use Cambalacheo\Repositories\ArticlesRepository;

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
}
