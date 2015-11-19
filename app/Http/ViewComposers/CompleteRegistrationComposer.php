<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;

class CompleteRegistrationComposer
{
    public function compose(View $view)
    {
        $user = auth()->user();

        $complete_registration = false;
        $states = [];

        if ($user && ($user->city_id == 0 || $user->state_id == 0)) {
            $complete_registration = true;
            $states = \App\State::lists('name', 'id');
        }


        $view->with(compact('complete_registration', 'user', 'states'));
    }
}