<?php

namespace App\Http\Controllers;

use Cambalacheo\Services\SitemapService;
use App\Http\Controllers\Controller;

class SitemapController extends Controller
{
    public function articles()
    {
        return (new SitemapService())->articles();
    }

    public function categories()
    {
        return (new SitemapService())->categories();
    }
}
