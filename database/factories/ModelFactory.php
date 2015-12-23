<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name'           => $faker->name,
        'email'          => $faker->email,
        'password'       => bcrypt(str_random(10)),
        'state_id'       => 26,
        'city_id'        => 2672,
        'avatar'         => '',
        'provider'       => '',
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Article::class, function (Faker\Generator $faker) {
    $title = $faker->sentence;
    return [
        'title'        => $title,
        'slug'         => str_slug($title),
        'description'  => $faker->paragraph,
        'request'      => $faker->sentence,
        'category_id'  => $faker->numberBetween(1, 36),
        'condition_id' => $faker->numberBetween(1, 3),
        'user_id'      => 1,
        'status'       => 1
    ];
});

$factory->define(App\Image::class, function (Faker\Generator $faker) {
    return [
        'article_id' => 1,
        'user_id'    => 1,
        'file_size'  => 1,
        'file_mime'  => 'image/png'
    ];
});

$factory->define(App\Category::class, function (Faker\Generator $faker) {
    $name = $faker->sentence(2);
    return [
        'name'   => $name,
        'slug'   => str_slug($name),
        'status' => 1
    ];
});

