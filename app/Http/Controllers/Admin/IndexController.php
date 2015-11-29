<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __construct()
    {
        $this->authorize('admin');
    }

    public function index()
    {
        return view('admin.index.index');
    }

    public function users()
    {
        $users = \App\User::paginate(20);

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
