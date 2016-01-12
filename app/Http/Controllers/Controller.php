<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * The authenticate user.
     *
     * @var \App\User|null
     */
    protected $user;

    /**
     * Is the user signed in?
     *
     * @var \App\User|null
     */
    protected $signedIn;

    /**
     * Create a new controller instance
     */
    public function __construct()
    {
        $this->user     = Auth::user();
        $this->signedIn = Auth::check();

        view()->share('user', $this->user);
        view()->share('signedIn', $this->signedIn);
    }
}
