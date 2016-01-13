<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Cambalacheo\Presenter\CategoryPresenter;

class Category extends Model
{
    use PresentableTrait;

    protected $table = 'categories';

    protected $presenter = CategoryPresenter::class;

    public function articles()
    {
    	return $this->hasMany('App\Article');
    }

    public function articlesCount()
    {
    	return $this->hasOne('App\Article')
    		->selectRaw('category_id, count(*) as aggregate')
            ->where('status', ARTICLE_STATUS_OPEN)
    		->groupBy('category_id');
    }

    public function getArticlesCountAttribute()
    {
    	if (!array_key_exists('articlesCount', $this->relations))
    		$this->load('articlesCount');

    	$related = $this->getRelation('articlesCount');

    	return ($related) ? (int) $related->aggregate : 0;
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
