<?php

namespace Cambalacheo\Social;

use App\Article;

interface AlertInterface
{
    public function send(Article $article);
}