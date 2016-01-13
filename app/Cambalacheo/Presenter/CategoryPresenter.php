<?php

namespace Cambalacheo\Presenter;

use Laracasts\Presenter\Presenter;

class CategoryPresenter extends Presenter
{
    public function url()
    {
        return url("categoria/{$this->slug}");
    }
}
