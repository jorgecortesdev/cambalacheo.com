<?php

namespace App\Http\Controllers;

use Cambalacheo\Facades\Articles;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{

    public function index()
    {
        $articles = Articles::getRecent();
        $featured = Articles::getFeatured();

        return view('index.index', compact('articles', 'featured'));
    }

}
