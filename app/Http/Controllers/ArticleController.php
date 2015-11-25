<?php

namespace App\Http\Controllers;

use Auth;
use File;
use Storage;
use Validator;
use App\Article;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Helpers\ArticleImage;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;

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
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request, ArticleImage $articleImage)
    {
        $article = new Article($request->all());
        $user_id = Auth::user()->id;
        $article->user_id = $user_id;
        $article->save();

        $files = $request->file('image');
        $articleImage->processUploadImages($article, $files);

        flash()->success('Tu artículo ha sido creado.');

        return redirect('/panel');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $article = Article::with(
            'category', 'offers', 'questions', 'user.state', 'images', 'user.city'
        )
        ->whereSlug($slug)
        ->firstOrFail();

        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, $article_id, ArticleImage $articleImage)
    {
        $data            = $request->all();
        $data['user_id'] = Auth::user()->id;

        $article = Article::findOrFail($article_id);
        $article->update($data);

        // Guardar nuevas imagenes
        $image_files = $request->file('image');
        $articleImage->processUploadImages($article, $image_files);

        // Remover imagenes
        $remove_images = $request->input('remove_images', []);
        $articleImage->destroy($article, $remove_images);

        flash()->success('Tu artículo ha sido actualizado.');

        return redirect()->back();
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

        return redirect('/panel');
    }
}
