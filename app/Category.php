<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

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
}
