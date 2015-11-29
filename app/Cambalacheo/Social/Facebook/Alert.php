<?php

namespace Cambalacheo\Social\Facebook;

use Cdn;
use App\Article;
use App\FacebookApp;
use Cambalacheo\Social\AlertInterface;
use Facebook\Exceptions\FacebookSDKException;
use SammyK\LaravelFacebookSdk\LaravelFacebookSdk;

class Alert implements AlertInterface
{
    protected $page_id;
    protected $token;
    protected $facebook;

    public function __construct($page_id)
    {
        $facebookApp = \App\FacebookApp::find(1);
        $this->token = $facebookApp->token;

        $this->page_id = $page_id;
        $this->facebook = \App::make('SammyK\LaravelFacebookSdk\LaravelFacebookSdk');
    }

    protected function format(Article $article)
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

    public function send(Article $article)
    {
        $this->facebook->setDefaultAccessToken($this->token);

        $post = $this->format($article);

        try {
            $response = $this->facebook->post('/' . $this->page_id . '/feed', $post);
        } catch (FacebookSDKException $e) {
            dd($e->getMessage());
        }
    }
}