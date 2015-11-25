<?php

namespace App\Http\ViewComposers;

use Auth;
use Config;
use App\Category;
use Illuminate\Contracts\View\View;

class ArticleComposer
{
    public function compose(View $view)
    {
        $categories = Category::lists('name', 'id');

        $conditions = array_pluck(
            Config::get('constants.conditions'),
            'name',
            'id'
        );

        $article_status = Config::get('constants.status_article');

        $logged_user_id = false;
        if (Auth::check()) {
            $logged_user_id = Auth::user()->id;
        }

        $view->with(compact('categories', 'conditions', 'article_status', 'logged_user_id'));
    }
}