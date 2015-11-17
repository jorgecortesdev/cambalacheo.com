<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MigrationController extends Controller
{
    public function categories_slug()
    {
        $categories = \App\Category::all();
        foreach ($categories as $category) {
            $name = str_replace('/', ' ', $category->name);
            $category->slug = str_slug($name);
            $category->save();
        }

        echo "Done";
    }
}
