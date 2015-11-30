<?php

namespace App\Http\Controllers\Admin;

use Facebook;
use App\Article;
use App\FacebookApp;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cambalacheo\Social\Facebook\Alert;
use Cambalacheo\Social\Facebook\Token;

class FacebookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['create']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facebookApps = FacebookApp::all();
        $loginUrl     = Facebook::getLoginUrl([
            'manage_pages',
            'publish_pages',
            'publish_actions'
        ]);
        return view('admin.facebook.index', compact('facebookApps', 'loginUrl'));
    }

    /**
     * Postea un articulo a la pagina de facebook de cambalacheo.
     *
     * @param  integer $article_id
     * @return void
     */
    public function post(Request $request)
    {
        $article_id = $request->article_id;
        $article    = Article::find($article_id);

        $alert = new Alert;
        $alert->send($article);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fbToken = new Token;
        $token = $fbToken->requestPageToken(env('FACEBOOK_PAGE_ID'), $request->url());
        $facebookApp = FacebookApp::firstOrNew(['id' => 1]);
        $facebookApp->token = $token;
        $facebookApp->save();

        return redirect()->back();
    }
}

