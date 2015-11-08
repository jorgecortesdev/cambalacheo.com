<?php

namespace App\Http\ViewComposers;

use Auth;
use Route;

use App\Article;
use App\Offer;
use App\Question;

use Illuminate\Contracts\View\View;

class PanelMenuComposer
{
    public function compose(View $view)
    {
        $uri = Route::current()->getUri();
        if ($uri == 'panel' || $uri == 'home') {
            $menu_active = 'articles';
        } else {
            $menu_active = substr(
                $uri,
                strrpos($uri, '/') + 1,
                strlen($uri)
            );
        }

        $view->with(['menu_active' => $menu_active]);
    }
}