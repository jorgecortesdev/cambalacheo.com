<?php

namespace App\Http\ViewComposers;

use Auth;
use Route;

use App\Article;
use App\Offer;
use App\Question;

use Illuminate\Contracts\View\View;

class PanelMenuComposer
{
    public function compose(View $view)
    {
        $user_id = Auth::user()->id;

        $number_articles = Article::where([
            'user_id' => $user_id, 
            'status'  => ARTICLE_STATUS_OPEN,
        ])->count();

        $offer = new Offer;
        $number_offers = $offer->userOffersCount($user_id);

        $question = new Question;
        $number_questions = $question->userQuestionsCount($user_id);

        $uri = Route::current()->getUri();
        if ($uri == 'panel') {
            $menu_active = 'index';
        } else {
            $menu_active = substr(
                $uri,
                strrpos($uri, '/') + 1,
                strlen($uri)
            );
        }

        $view->with([
            'number_articles'  => $number_articles,
            'number_offers'    => $number_offers,
            'number_questions' => $number_questions,
            'menu_active'      => $menu_active,
        ]);
    }
}