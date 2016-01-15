<?php

namespace Cambalacheo\Repositories;

use Carbon\Carbon;

interface ArticlesRepository
{
    public function byDate(Carbon $date = null, $limit = 10);

    public function byFeatured($limit = 8);
}
