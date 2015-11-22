<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = \App\City::orderBy(\DB::raw('RAND()'))->take(5)->get()->toArray();

        factory(App\User::class, 10)->create()->each(function($user) use ($cities) {
            $key            = mt_rand(0, 4);
            $user->email    = str_random(6) . '@cambalacheo.com';
            $user->password = bcrypt('secret');
            $user->state_id = $cities[$key]['state_id'];
            $user->city_id  = $cities[$key]['id'];
            $user->save();
        });
    }
}
