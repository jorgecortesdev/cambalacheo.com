<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Offer;
use App\Article;
use App\Question;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __construct()
    {
        $this->authorize('admin');
    }

    public function index()
    {
        $users_count     = User::count();
        $articles_count  = Article::count();
        $questions_count = Question::count();
        $offers_count    = Offer::count();

        return view('admin.index.index', compact(
            'users_count', 'articles_count', 'questions_count', 'offers_count'
        ));
    }

    public function users()
    {
        $users = \App\User::latest()->paginate(20);

        return view('admin.index.users', compact('users'));
    }

    public function articles()
    {
        $articles = \App\Article::paginate(20);

        return view('admin.index.articles', compact('articles'));
    }

    public function images()
    {
        $images = \App\Image::with('article')->paginate(20);

        return view('admin.index.images', compact('images'));
    }
}
