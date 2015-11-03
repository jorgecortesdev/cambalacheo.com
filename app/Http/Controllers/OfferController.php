<?php

namespace App\Http\Controllers;

use Auth;

use App\Article;
use App\Offer;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class OfferController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create($article_id)
    {
        $article = \App\Article::find($article_id);
        return view('offers.create', compact('article'));
    }

    public function replay(Request $request)
    {
        $rules = [
            'description' => 'required|min:10|max:255',
        ];
        $validator = \Validator::make($request->all(), $rules);
        if (!$validator->fails()) {
            $question = new Offer($request->all());
            $question->user_id = Auth::user()->id;
            $question->save();
        }
        return redirect('trades/' . $request->article_id);
    }

    public function store(Request $request)
    {
        $offer = new Offer($request->all());
        $offer->user_id = Auth::user()->id;
        $offer->save();

        return redirect('trades/' . $offer->article_id);
    }

    public function reject($offer_id)
    {
        $offer = Offer::find($offer_id);
        $owner_user_id = $offer->article->user_id;
        $logged_user_id = Auth::user()->id;
        if ($owner_user_id == $logged_user_id) {
            $offer->status = OFFER_STATUS_REJECTED;
            $offer->save();
        }
        return redirect('trades/' . $offer->article_id);
    }

    public function accept($offer_id)
    {
        $offer = Offer::find($offer_id);
        $article = $offer->article;
        $owner_user_id = $article->user_id;
        $logged_user_id = Auth::user()->id;
        if ($owner_user_id == $logged_user_id) {
            $article->status = ARTICLE_STATUS_EXCHANGE;
            $article->save();
            $offer->status = OFFER_STATUS_ACCEPTED;
            $offer->save();
        }
        return redirect('trades/' . $offer->article_id);
    }
}
