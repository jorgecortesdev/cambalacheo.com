<?php

namespace App\Http\ViewComposers;

use Auth;
use Route;

use App\Article;
use App\Offer;
use App\Question;

use Illuminate\Contracts\View\View;

class NavigationMenuComposer
{
    public function compose(View $view)
    {
        $uri = Route::current()->getUri();

        switch ($uri) {
            case strpos($uri, 'panel') !== false:
                $menu_active = 'panel';
                break;
            case 'auth/login':
                $menu_active = 'login';
                break;
            case 'auth/register';
                $menu_active = 'register';
                break;
            default:
                $menu_active = 'index';
                break;
        }

        $view->with(['menu_active' => $menu_active]);
    }
}