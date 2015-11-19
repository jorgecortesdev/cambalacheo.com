<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;

class MasterCategoriesComposer
{
	public function compose(View $view)
	{
        $categories = \Cache::remember('categories_count', 1, function() {
            return \App\Category::with('articlesCount')->where('status', 1)->get();
        });
		$view->with('categories', $categories);
	}
}