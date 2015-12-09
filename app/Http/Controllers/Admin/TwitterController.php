<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cambalacheo\Social\Twitter\Alert;

class TwitterController extends Controller
{
    public function post(Request $request)
    {
        $article_id = $request->article_id;
        $article    = Article::find($article_id);

        $alert = new Alert;
        $alert->send($article);
    }
}
