<?php

namespace App\Http\Controllers\Admin;

use App\StatsImage;
use App\Http\Requests;
use App\StatsUsersProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class StatsController extends Controller
{
    public function __construct()
    {
        $this->authorize('admin');
    }

    public function images()
    {
        $stats = StatsImage::select(
            'file_mime as label',
            'total as value'
        )->get();
        return $stats;
    }

    public function usersProviders()
    {
        $stats = StatsUsersProvider::select(
            DB::raw('if(provider = "", "cambalacheo", provider) as label'),
            'total as value'
        )->get();
        return $stats;
    }
}
