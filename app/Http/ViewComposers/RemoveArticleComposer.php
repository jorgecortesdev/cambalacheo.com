<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;

class RemoveArticleComposer
{
    public function compose(View $view)
    {
        $reasons = [
            ARTICLE_STATUS_PERMUTED_USER => 'Ya lo cambie',
            ARTICLE_STATUS_RETIRED_USER  => 'No lo voy a cambiar',
            ARTICLE_STATUS_CLOSE_USER    => 'Solo deseo removerlo'
        ];

        $view->with(compact('reasons'));
    }
}