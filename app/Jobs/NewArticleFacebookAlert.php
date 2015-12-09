<?php

namespace App\Jobs;

use Cambalacheo\Social\Facebook\Alert;

class NewArticleFacebookAlert extends NewArticleAlert
{
    public function setup()
    {
        $this->alert = new Alert();
    }
}
