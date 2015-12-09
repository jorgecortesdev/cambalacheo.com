<?php

namespace Cambalacheo\Social\Twitter;

use App\Article;
use Thujohn\Twitter\Facades\Twitter;
use Cambalacheo\Social\AlertInterface;

class Alert implements AlertInterface
{
    protected function format(Article $article)
    {
        $status = sprintf(
            "Nuevo artículo: %s %s #cambalacheo #trueque",
            str_limit($article->title, 50),
            url('/articulo/' . $article->slug)
        );

        $post = [
            'status' => $status,
            'format' => 'json'
        ];

        return $post;
    }

    public function send(Article $article)
    {
        $post     = $this->format($article);
        $response = Twitter::postTweet($post);
    }
}