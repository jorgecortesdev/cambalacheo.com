<?php

namespace App\Http\Controllers\Admin;

use App\State;
use App\Category;
use App\StatsImage;
use App\StatsTotal;
use App\Http\Requests;
use App\StatsUsersProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpKernel\Exception\HttpException;

class StatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        try {
            $this->authorize('admin');
        } catch(HttpException $e) {
            return redirect('/panel');
        }
    }

    public function imagesMimes()
    {
        $stats = Cache::remember('stats_images_mimes', 6, function() {
            return StatsTotal::select(
                    'value AS label',
                    'total AS value'
                )->where([
                    'table'  => 'images',
                    'column' => 'file_mime'
                ])->get();
        });
        return $stats;
    }

    public function usersProviders()
    {
        $stats = Cache::remember('stats_users_providers', 6, function() {
            return StatsTotal::select(
                    DB::raw('IF(value = "", "cambalacheo", value) AS label'),
                    'total AS value'
                )->where([
                    'table'  => 'users',
                    'column' => 'provider'
                ])->get();
        });
        return $stats;
    }

    public function usersStates()
    {
        $stats = Cache::remember('stats_users_states', 6, function() {
            return State::select(
                    'name AS label',
                    DB::raw('IFNULL(total, 0) AS value')
                )->leftJoin('stats_totals', function($join) {
                    $join->on('states.id', '=', 'stats_totals.value')
                        ->where('table', '=', 'users')
                        ->where('column', '=', 'state_id');
                })->orderBy('states.id', 'asc')->get();
        });
        return $stats;
    }

    public function articlesConditions()
    {
        $stats = Cache::remember('stats_articles_conditions', 6, function() {
            $conditions = array_pluck(
                Config::get('constants.conditions'),
                'name',
                'id'
            );
            $case = "(CASE
                WHEN value = 1 THEN '{$conditions[1]}' ELSE
                    (CASE
                        WHEN value = 2 THEN '{$conditions[2]}' ELSE
                            (CASE
                                WHEN value = 3 THEN '{$conditions[3]}'
                            END)
                    END)
                END) as label";
            return StatsTotal::select(
                    DB::raw($case),
                    'total AS value'
                )->where([
                    'table'  => 'articles',
                    'column' => 'condition_id'
                ])->get();
        });
        return $stats;
    }

    public function articlesCategories()
    {
        $stats = Cache::remember('stats_articles_categories', 6, function() {
            return Category::select(
                    'name AS label',
                    DB::raw('IFNULL(total, 0) AS value')
                )->leftJoin('stats_totals', function($join) {
                    $join->on('categories.id', '=', 'stats_totals.value')
                        ->where('table', '=', 'articles')
                        ->where('column', '=', 'category_id');
                })->orderBy('categories.id', 'asc')->get();
        });
        return $stats;
    }

    public function articlesStatuses()
    {
        $stats = Cache::remember('stats_articles_status', 6, function() {
            return StatsTotal::select(
                    'value AS label',
                    'total AS value'
                )->where([
                    'table'  => 'articles',
                    'column' => 'status'
                ])->get();
        });
        return $stats;
    }

    public function offersStatuses()
    {
        $stats = Cache::remember('stats_offers_status', 6, function() {
            $status = Config::get('constants.status_offer');
            $case = "(CASE
                WHEN value = 1 THEN '{$status[1]}' ELSE
                    (CASE
                        WHEN value = 2 THEN '{$status[2]}' ELSE
                            (CASE
                                WHEN value = 3 THEN '{$status[3]}'
                            END)
                    END)
                END) as label";
            return StatsTotal::select(
                    DB::raw($case),
                    'total AS value'
                )->where([
                    'table'  => 'offers',
                    'column' => 'status'
                ])->get();
        });
        return $stats;
    }
}
