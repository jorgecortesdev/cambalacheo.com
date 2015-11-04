<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Cdn extends Facade
{
    protected static function getFacadeAccessor() 
    { 
        return '\App\Helpers\Cdn'; 
    }
}
