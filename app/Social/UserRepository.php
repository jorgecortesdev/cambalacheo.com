<?php

namespace App\Social;

use App\User;

class UserRepository
{
    public function findByUserNameOrCreate($userData, $provider)
    {
        $user = User::where('email', '=', $userData->email)->first();
        if(!$user) {
            $user = User::create([
                'provider_id' => $userData->id,
                'provider'    => $provider,
                'name'        => $userData->name,
                'email'       => $userData->email,
                'avatar'      => $userData->avatar
            ]);
        }
        $this->checkIfUserNeedsUpdating($userData, $user);
        return $user;
    }

    public function checkIfUserNeedsUpdating($userData, $user)
    {
        $socialData = [
            'avatar'   => $userData->avatar,
            'email'    => $userData->email,
            'name'     => $userData->name,
        ];
        $dbData = [
            'avatar'   => $user->avatar,
            'email'    => $user->email,
            'name'     => $user->name,
        ];

        if (!empty(array_diff($socialData, $dbData))) {
            $user->avatar   = $userData->avatar;
            $user->email    = $userData->email;
            $user->name     = $userData->name;
            $user->save();
        }
    }
}