<?php

namespace Cambalacheo\Repositories;

use Carbon\Carbon;

interface ArticlesRepository
{
    public function byDate(Carbon $date = null, $limit = 10);

    public function byFeatured($limit = 8);

    public function byLocation($state_id, $city_id, $limit = 10);

    public function byCategory($category_id, $limit = 10);

    public function byCondition($condition_id, $limit = 10);
}
