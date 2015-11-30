<?php

namespace App\Http\Controllers\Admin;

use App\StatsImage;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatsController extends Controller
{
    public function __construct()
    {
        $this->authorize('admin');
    }

    public function images()
    {
        $stats = StatsImage::select('file_mime as label', 'total as value')->get();
        return $stats;
    }
}
