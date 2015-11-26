<?php

namespace App\Social\Facebook;

use Cdn;
use App\Article;
use App\FacebookApp;
use Facebook\Exceptions\FacebookSDKException;
use SammyK\LaravelFacebookSdk\LaravelFacebookSdk;

class Post
{
    protected $page_id;
    protected $token;
    protected $facebook;

    public function __construct()
    {
        $facebookApp = \App\FacebookApp::find(1);
        $this->token = $facebookApp->token;

        $this->page_id = 1004556389607584;
        $this->facebook = \App::make('SammyK\LaravelFacebookSdk\LaravelFacebookSdk');
    }

    public function create(Article $article)
    {
        $this->facebook->setDefaultAccessToken($this->token);

        $post = $this->build($article);

        try {
            $response = $this->facebook->post('/' . $this->page_id . '/feed', $post);
        } catch (FacebookSDKException $e) {
            dd($e->getMessage());
        }
    }

    protected function build(Article $article)
    {
        $post = [
            "message"     => "Nuevo artículo publicado",
            "link"        => url('/articulo/' . $article->slug),
            "picture"     => Cdn::image($article->images->first(), 'original'),
            "name"        => $article->title,
            "description" => $article->description,
            "caption"     => "cambalacheo.com",
        ];

        return $post;
    }
}