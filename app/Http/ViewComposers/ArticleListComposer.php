<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;

class ArticleListComposer
{
	public function compose(View $view)
	{
    	$conditions = \Config::get('constants.conditions');
		$view->with('conditions', $conditions);
	}
}