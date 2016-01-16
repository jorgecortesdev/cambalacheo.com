<?php

namespace App\Http\Controllers;

use Config;
use App\Article;
use App\Http\Requests\SearchRequest;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function search(SearchRequest $request)
    {
        $limit = Config::get('constants.main_article_list_limit');
        $query = $request->get('query');
        $articles = Article::with('category', 'user.state', 'user.city', 'images')
            ->latest()
            ->search($query)
            ->paginate($limit);
        return view('search.search', compact('articles', 'query'));
    }
}
