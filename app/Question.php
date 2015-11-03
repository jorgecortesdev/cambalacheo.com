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

    public function replays()
    {
        return $this->hasMany('App\Question', 'parent_id');
    }

    public function userQuestionsCount($user_id)
    {
        return $this->join('articles', 'articles.id', '=', 'questions.article_id')
            ->where([
                'questions.user_id' => $user_id,
                'questions.status'  => QUESTION_STATUS_OPEN,
                'questions.parent_id' => 0,
                'articles.status' => ARTICLE_STATUS_OPEN,
            ])->get()->count();
    }
}
