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

    public function replays()
    {
        return $this->hasMany('App\Offer', 'parent_id');
    }

    public function userOffersCount($user_id)
    {
        return $this->join('articles', 'articles.id', '=', 'offers.article_id')
            ->where([
                'offers.user_id' => $user_id,
                'offers.status'  => OFFER_STATUS_OPEN,
                'offers.parent_id' => 0,
                'articles.status' => ARTICLE_STATUS_OPEN,
            ])->get()->count();
    }
}
