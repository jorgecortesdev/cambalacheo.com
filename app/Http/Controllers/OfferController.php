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
        $rules = [
            'description' => 'required|min:10|max:255',
        ];
        $validator = \Validator::make($request->all(), $rules);
        if (!$validator->fails()) {
            $offer = new Offer($request->all());
            $offer->user_id = Auth::user()->id;
            $offer->save();

            $this->dispatch(new \App\Jobs\SendOfferReplayEmail($offer));
        }
        return redirect('trades/' . $request->article_id);
    }

    public function store(OfferRequest $request)
    {
        $offer = new Offer($request->all());
        $offer->user_id = Auth::user()->id;
        $offer->save();
        Event::fire(new \App\Events\OfferStore($offer));
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
            $this->dispatch(new \App\Jobs\SendOfferRejectedEmail($offer));
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
            $article->status = ARTICLE_STATUS_PERMUTED;
            $article->save();
            $offer->status = OFFER_STATUS_ACCEPTED;
            $offer->save();

            $job  = (new \App\Jobs\SendOfferAcceptedEmail($offer))->onQueue('emails');
            $this->dispatch($job);
        }
        return redirect('trades/' . $offer->article_id);
    }
}
