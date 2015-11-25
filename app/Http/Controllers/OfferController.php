<?php

namespace App\Http\Controllers;

use Auth;
use Event;

use App\Article;
use App\Offer;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\OfferRequest;
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
        $article = \App\Article::findOrFail($request->article_id);

        $rules = [
            'description' => 'required|min:10|max:255',
        ];
        $validator = \Validator::make($request->all(), $rules);
        if (!$validator->fails()) {
            $offer = new Offer($request->all());
            $offer->user_id = Auth::user()->id;
            $offer->save();
            flash()->success('Tu respuesta ha sido enviada.');
            $this->dispatch(new \App\Jobs\SendOfferReplayEmail($offer));
        }
        return redirect('articulo/' . $article->slug);
    }

    public function store(OfferRequest $request)
    {
        $article = \App\Article::findOrFail($request->article_id);
        $offer = new Offer($request->all());
        $offer->user_id = Auth::user()->id;
        $offer->save();
        flash()->success('Tu oferta ha sido enviada.');
        Event::fire(new \App\Events\OfferStore($offer));
        return redirect('articulo/' . $article->slug);
    }

    public function reject($offer_id)
    {
        $offer = Offer::findOrFail($offer_id);
        $article = \App\Article::find($offer->article_id);
        $owner_user_id = $offer->article->user_id;
        $logged_user_id = Auth::user()->id;
        if ($owner_user_id == $logged_user_id) {
            $offer->status = OFFER_STATUS_REJECTED;
            $offer->save();
            flash()->error('Oferta rechazada.');
            $this->dispatch(new \App\Jobs\SendOfferRejectedEmail($offer));
        }
        return redirect('articulo/' . $article->slug);
    }

    public function accept($offer_id)
    {
        $offer = Offer::findOrFail($offer_id);
        $article = \App\Article::find($offer->article_id);
        $article = $offer->article;
        $owner_user_id = $article->user_id;
        $logged_user_id = Auth::user()->id;
        if ($owner_user_id == $logged_user_id) {
            $article->status = ARTICLE_STATUS_PERMUTED;
            $article->save();
            $offer->status = OFFER_STATUS_ACCEPTED;
            $offer->save();
            flash()->success('Oferta aceptada.');
            $this->dispatch(new \App\Jobs\SendOfferAcceptedEmail($offer));
        }
        return redirect('articulo/' . $article->slug);
    }
}
