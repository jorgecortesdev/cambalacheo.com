<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';

    protected $fillable = ['user_id', 'article_id', 'description', 'parent_id'];

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
        return $this->belongsTo('App\Question', 'parent_id');
    }

    public function replays()
    {
        return $this->hasMany('App\Question', 'parent_id');
    }

    public function scopeReceived($query, $user_id)
    {
        return $query->select('questions.*')
            ->join('articles', 'questions.article_id', '=', 'articles.id')
            ->with('article.images')
            ->where([
                'questions.parent_id' => 0,
                'questions.status'    => QUESTION_STATUS_OPEN,
                'articles.status'     => ARTICLE_STATUS_OPEN,
                'articles.user_id'    => $user_id
            ])
            ->where('questions.user_id', '<>', $user_id)
            ->latest();
    }

    public function scopeSent($query, $user_id)
    {
        return $query->select('questions.*')
            ->join('articles', 'questions.article_id', '=', 'articles.id')
            ->with('article.images')
            ->where([
                'questions.user_id'   => $user_id,
                'questions.parent_id' => 0,
                'questions.status'    => QUESTION_STATUS_OPEN,
                'articles.status'     => ARTICLE_STATUS_OPEN,
            ])
            ->latest();
    }
}
