<?php

namespace App\Http\Controllers;

use Config;
use Storage;
use File;
use Auth;
use Validator;

use App\Article;
use App\Category;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = \App\Category::lists('name', 'id');

        $conditions = Config::get('constants.conditions');

        return view('articles.create', compact('categories', 'conditions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'required'    => 'Este campo es requerido.',
            'title.max'   => 'No debe ser mayor a :max caracteres.',
            'title.min'   => 'No debe ser menor a :min caracteres.',
        ];

        $rules = [
            'title'        => 'required|min:5|max:255',
            'category_id'  => 'required',
            'condition_id' => 'required',
            'description'  => 'required|min:5|max:255',
            'request'      => 'required|min:5|max:255',
        ];

        // Upload the image
        $image_files = $request->file('image');
        foreach (range(0, count($image_files) - 1) as $index) {
            $rules['image.' . $index]               = 'required|image';
            $messages['image.' . $index . '.image'] = 'Una de las imagenes no es válida.';
        }
        
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect('/panel/article/create')
                ->withErrors($validator)
                ->withInput();
        }

        $user_id = Auth::user()->id;

        $article = new Article($request->all());
        $article->user_id = $user_id;
        $article->save();

        foreach($image_files as $key => $file) {
         Storage::disk('local')->put(
             $article->id . "-" . ++$key,
             File::get($file)
         );
        }

        return redirect('/panel/articles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::with('category', 'offers', 'questions', 'user.state')->find($id);

        $article_conditions = Config::get('constants.conditions');

        $article_status = Config::get('constants.status_article');

        $category_id = $article->category_id;
        $article_id = $article->id;

        $more_articles = Article::where('category_id', $category_id)
            ->where('id', '!=', $article_id)
            ->where('status', ARTICLE_STATUS_OPEN)
            ->get()
            ->chunk(4);

        $images = array();
        for ($i = 2; $i < 6; $i++) {
            if (Storage::exists($article_id . "-{$i}")) {
                $images[] = $i;
            }
        }

        $logged_user_id = false;
        if (Auth::check()) {
            $logged_user_id = Auth::user()->id;
        }

        return view(
            'articles.show', 
            compact(
                'article', 
                'article_conditions', 
                'article_status', 
                'more_articles', 
                'images',
                'logged_user_id'
            )
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);

        $categories = \App\Category::lists('name', 'id');

        $conditions = Config::get('constants.conditions');

        return view('articles.edit', compact('article', 'categories', 'conditions'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $article_id)
    {
        $messages = [
            'required'    => 'Este campo es requerido.',
            'title.max'   => 'No debe ser mayor a :max caracteres.',
            'title.min'   => 'No debe ser menor a :min caracteres.',
            'request.min' => 'No debe ser menor a :min caracteres.',
        ];

        $rules = [
            'title'        => 'required|min:5|max:255',
            'category_id'  => 'required',
            'condition_id' => 'required',
            'description'  => 'required|min:5|max:255',
            'request'      => 'required|min:5|max:255',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect('/panel/articles/edit/' . $article_id)
                ->withErrors($validator)
                ->withInput();
        }
        
        $data                 = $request->all();
        $article              = Article::find($article_id);
        $article->title       = $data['title'];
        $article->category_id = (int) $data['category_id'];
        $article->condition_id = (int) $data['condition_id'];
        $article->description  = $data['description'];
        $article->request      = $data['request'];

        $article->save();

        return redirect($request->redirects_to);
    }

    public function change_status(Request $request)
    {
        $validator = Validator::make($request->all(), ['status' => 'required']);

        if (!$validator->fails()) {
            $data = $request->all();
            $article = Article::find($data['article_id']);
            $article->status = $data['status'];
            $article->save();
        }

        return redirect('/panel/articles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
