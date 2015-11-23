<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table = 'offers';

    protected $fillable = ['user_id', 'article_id', 'description', 'parent_id', 'status'];

    public function article()
    {
    	return $this->belongsTo('App\Article');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function parent()
    {
        return $this->belongsTo('App\Offer', 'parent_id');
    }

    public function replays()
    {
        return $this->hasMany('App\Offer', 'parent_id');
    }

    public function scopeReceived($query, $user_id)
    {
        return $query->select('offers.*')
            ->join('articles', 'offers.article_id', '=', 'articles.id')
            ->with('article.images')
            ->where([
                'offers.parent_id' => 0,
                'offers.status'    => OFFER_STATUS_OPEN,
                'articles.status'  => ARTICLE_STATUS_OPEN,
                'articles.user_id' => $user_id
            ])
            ->where('offers.user_id', '<>', $user_id)
            ->latest();
    }

    public function scopeSent($query, $user_id)
    {
        return $query->select('offers.*')
            ->join('articles', 'offers.article_id', '=', 'articles.id')
            ->with('article.images')
            ->where([
                'offers.user_id'   => $user_id,
                'offers.parent_id' => 0,
                'offers.status'    => OFFER_STATUS_OPEN,
                'articles.status'  => ARTICLE_STATUS_OPEN,
            ])
            ->latest();
    }
}
