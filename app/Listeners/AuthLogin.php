<?php

namespace App\Listeners;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AuthLogin
{
    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  App\User $user
     * @param  boolean  $remember
     * @return void
     */
    public function handle(User $user, $remember)
    {
        $user->ip           = $this->request->getClientIp();
        $user->lastlogin_at = Carbon::now();
        $user->save();
    }
}
