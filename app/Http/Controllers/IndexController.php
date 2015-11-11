<?php

namespace App\Http\Controllers;

use Config;

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

    // TODO: Ajustar categorias, condiciones y ubicacion al nuevo diseño
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

    public function search(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'q' => 'min:3|max:25'

        ]);
        if ($validator->fails()) {
            $articles = new \Illuminate\Database\Eloquent\Collection;
            return view('index', compact('articles'));
        }

        $query = $request->q;

        $main_article_list_limit = Config::get('main_article_list_limit');

        $articles = \App\Article::where('title', 'LIKE', '%'.$query.'%')
            ->orWhere('description', 'LIKE', '%'.$query.'%')
            ->paginate($main_article_list_limit);

        return view('index', compact('articles', 'query'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact(Request $request)
    {
        if ($request->isMethod('post')) {
            $messages = [
                'required' => 'Este campo es requerido.',
                'max'      => 'No debe ser mayor a :max caracteres.',
                'min'      => 'No debe ser menor a :min caracteres.',
                'recaptcha'=> 'Indicanos que eres humano.'
            ];

            $rules = [
                'name'                 => 'required|min:5|max:255',
                'email'                => 'required|email|max:255',
                'message'              => 'required|min:5|max:255',
                'g-recaptcha-response' => 'required|recaptcha',
            ];

            $validator = \Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return redirect('contact')
                    ->withErrors($validator);
            }

            $data = $request->only('name', 'email', 'message');
            $this->dispatch(new \App\Jobs\SendContactEmail($data));

            return back()->with('message', 'Mensaje enviado');
        }

        return view('contact');
    }
}
