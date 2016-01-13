<?php

namespace Cambalacheo\Presenter;

use Laracasts\Presenter\Presenter;

class ArticlePresenter extends Presenter
{
    public function url()
    {
        return url("articulo/{$this->slug}");
    }
}
