<?php

namespace App\Social;

use App\Social\UserRepository;
use Illuminate\Contracts\Auth\Guard;
use Laravel\Socialite\Contracts\Factory as Socialite;

class AuthenticateUser
{
    private $socialite;
    private $auth;
    private $users;

    public function __construct(Socialite $socialite, Guard $auth, UserRepository $users)
    {
        $this->socialite = $socialite;
        $this->users     = $users;
        $this->auth      = $auth;
    }

    public function execute($hasCode, $listener, $provider)
    {
        if (! $hasCode) return $this->getAuthorizationFirst($provider);

        $user = $this->getUser($provider);
        $user = $this->users->findByUserNameOrCreate($user, $provider);
        $this->auth->login($user, true);

        return $listener->userHasLoggedIn($user);
    }

    private function getAuthorizationFirst($provider)
    {
        return $this->socialite->driver($provider)->redirect();
    }

    private function getUser($provider)
    {
        return $this->socialite->driver($provider)->user();
    }
}