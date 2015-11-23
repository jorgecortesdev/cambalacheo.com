<?php

namespace App\Http\Controllers;

use Auth;
use App\Offer;
use App\Article;
use App\Question;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PanelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user_id = Auth::user()->id;

        $articles_active = Article::status(
            $user_id, ARTICLE_STATUS_OPEN
        )->paginate(10);

        $articles_permuted = Article::status(
            $user_id, ARTICLE_STATUS_PERMUTED
        )->paginate(10);

        return view('panel.index', compact(
            'articles_active',
            'articles_permuted'
        ));
    }

    public function offers(Request $request)
    {
        $user_id         = Auth::user()->id;
        $offers_sent     = Offer::sent($user_id)->get();
        $offers_received = Offer::received($user_id)->get();

        return view('panel.offers', compact('offers_sent', 'offers_received'));
    }

    public function questions(Request $request)
    {
        $user_id            = Auth::user()->id;
        $questions_sent     = Question::sent($user_id)->get();
        $questions_received = Question::received($user_id)->get();

        return view('panel.questions', compact('questions_sent', 'questions_received'));
    }
}
