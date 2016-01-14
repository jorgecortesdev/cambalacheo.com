<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class StaticController extends Controller
{

   public function about()
    {
        return view('static.about');
    }

    public function terms()
    {
        return view('static.terms');
    }

    public function privacy()
    {
        return view('static.privacy');
    }

}
