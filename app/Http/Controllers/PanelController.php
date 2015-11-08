<?php

namespace App\Http\Controllers;

use Auth;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PanelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user_id = Auth::user()->id;

        $article = new \App\Article;
        $received_offers = $article->receivedOffers($user_id);

        $received_questions = $article->receivedQuestions($user_id);

    	return view('panel.index', compact('received_offers', 'received_questions'));
    }

    public function articles(Request $request)
    {
        $user_id = Auth::user()->id;

        $articles_active = \App\Article::where([
            'user_id' => $user_id,
            'status'  => ARTICLE_STATUS_OPEN
        ])->orderBy('created_at', 'desc')
        ->paginate(10);

        $articles_active_counter = \App\Article::where([
            'user_id' => $user_id,
            'status'  => ARTICLE_STATUS_OPEN
        ])->count();

        $articles_permuted = \App\Article::where([
            'user_id' => $user_id,
            'status'  => ARTICLE_STATUS_PERMUTED
        ])->orderBy('created_at', 'desc')
        ->paginate(10);

        $articles_permuted_counter = \App\Article::where([
            'user_id' => $user_id,
            'status'  => ARTICLE_STATUS_PERMUTED
        ])->count();

        $reasons = [
            ARTICLE_STATUS_PERMUTED_USER => 'Ya lo cambie',
            ARTICLE_STATUS_RETIRED_USER  => 'No lo voy a cambiar',
            ARTICLE_STATUS_CLOSE_USER    => 'Solo deseo removerlo'
        ];

        return view('panel.articles', compact(
            'articles_active',
            'articles_active_counter',
            'articles_permuted',
            'articles_permuted_counter',
            'reasons'
        ));
    }

    public function offers(Request $request)
    {
        $user_id = Auth::user()->id;

        $offers_sent = \App\Article::select('offers.description', 'articles.id', 'articles.title')
            ->with('images')
            ->join('offers', 'articles.id', '=', 'offers.article_id')
            ->where([
                'offers.user_id'   => $user_id,
                'offers.status'    => OFFER_STATUS_OPEN,
                'offers.parent_id' => 0,
                'articles.status'  => ARTICLE_STATUS_OPEN,
            ]
        )->get();

        $article = new \App\Article;
        $offers_received = $article->receivedOffers($user_id);

        return view('panel.offers', compact('offers_sent', 'offers_received'));
    }

    public function questions(Request $request)
    {
        $user_id = Auth::user()->id;

        $questions_sent = \App\Article::select('questions.description', 'articles.id', 'articles.title')
            ->with('images')
            ->join('questions', 'articles.id', '=', 'questions.article_id')
            ->where([
                'questions.user_id'   => $user_id,
                'questions.status'    => QUESTION_STATUS_OPEN,
                'questions.parent_id' => 0,
                'articles.status'     => ARTICLE_STATUS_OPEN,
            ]
        )->get();

        $article = new \App\Article;
        $questions_received = $article->receivedQuestions($user_id);

        return view('panel.questions', compact('questions_sent', 'questions_received'));
    }
}
