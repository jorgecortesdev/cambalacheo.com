<?php

namespace App\Http\Controllers;

use Event;
use Config;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\SearchRequest;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{

    public function index()
    {
        $main_article_list_limit = Config::get('constants.main_article_list_limit');

        $articles = \App\Article::with('category', 'user.state')
            ->where('status', ARTICLE_STATUS_OPEN)
            ->orderBy('created_at', 'desc')
            ->paginate($main_article_list_limit);

        $featured_articles = \App\Article::orderBy(\DB::raw('RAND()'))->take(4)->get();

        return view('index', compact('articles', 'featured_articles'));
    }

    public function category(Request $request)
    {
        $category_id = $request->category_id;

        $main_article_list_limit = Config::get('constants.main_article_list_limit');

        $category = \App\Category::find($category_id);

        $articles = \App\Article::with('category')
            ->where(['category_id' => $category_id, 'status' => ARTICLE_STATUS_OPEN])
            ->orderBy('created_at', 'desc')
            ->paginate($main_article_list_limit);

        return view('index', compact('articles', 'category'));
    }


    public function condition(Request $request)
    {
        $condition_id = $request->condition_id;

        $main_article_list_limit = Config::get('constants.main_article_list_limit');

        $conditions = \Config::get('constants.conditions');

        $articles = \App\Article::with('category')
            ->where(['condition_id' => $condition_id, 'status' => ARTICLE_STATUS_OPEN])
            ->orderBy('created_at', 'desc')
            ->paginate($main_article_list_limit);

        return view('index', compact('articles', 'conditions', 'condition_id'));
    }

    public function location(Request $request)
    {
        $state_id = $request->state_id;
        $city_id  = $request->city_id;

        $main_article_list_limit = Config::get('constants.main_article_list_limit');

        $location = \App\State::join('cities', 'cities.state_id', '=', 'states.id')
            ->select('states.short', 'cities.name')
            ->where(['state_id' => $state_id, 'cities.id' => $city_id])
            ->get()
            ->first();

        $articles = \App\Article::join('users', 'users.id', '=', 'user_id')
            ->select('articles.*')
            ->where(['users.state_id' => $state_id, 'city_id' => $city_id])
            ->paginate($main_article_list_limit);

        return view('index', compact('articles', 'location'));
    }

    public function search(SearchRequest $request)
    {
        $query = $request->q;
        $articles = \App\Article::search($query);
        return view('index', compact('articles', 'query'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact(ContactRequest $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->only('name', 'email', 'message', 'registered');
            Event::fire(new \App\Events\ContactSent($data));
            return back()->with('message', 'Mensaje enviado');
        }

        return view('contact');
    }
}
