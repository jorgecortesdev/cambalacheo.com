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

        $articles = \App\Article::where('user_id', $user_id)
            ->where('status', ARTICLE_STATUS_OPEN)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $reasons = [
            ARTICLE_STATUS_EXCHANGE_USER => 'Ya lo cambie',
            ARTICLE_STATUS_RETIRED_USER  => 'No lo voy a cambiar',
            ARTICLE_STATUS_CLOSE_USER    => 'Solo deseo removerlo'
        ];

        return view('panel.articles', compact('articles', 'reasons'));
    }

    public function offers(Request $request)
    {
        $user_id = Auth::user()->id;

        $offers = \App\Article::select('offers.description', 'articles.id', 'articles.title')
            ->with('images')
            ->join('offers', 'articles.id', '=', 'offers.article_id')
            ->where([
                'offers.user_id'   => $user_id,
                'offers.status'    => OFFER_STATUS_OPEN,
                'offers.parent_id' => 0,
                'articles.status'  => ARTICLE_STATUS_OPEN,
            ]
        )->get();

        return view('panel.offers', compact('offers'));
    }

    public function questions(Request $request)
    {
        $user_id = Auth::user()->id;

        $questions = \App\Article::select('questions.description', 'articles.id', 'articles.title')
            ->with('images')
            ->join('questions', 'articles.id', '=', 'questions.article_id')
            ->where([
                'questions.user_id'   => $user_id,
                'questions.status'    => QUESTION_STATUS_OPEN,
                'questions.parent_id' => 0,
                'articles.status'     => ARTICLE_STATUS_OPEN,
            ]
        )->get();

        return view('panel.questions', compact('questions'));
    }
}
