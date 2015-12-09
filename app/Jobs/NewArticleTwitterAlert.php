<?php

namespace App\Jobs;

use Cambalacheo\Social\Twitter\Alert;

class NewArticleTwitterAlert extends NewArticleAlert
{
    public function setup()
    {
        $this->alert = new Alert();
    }
}
