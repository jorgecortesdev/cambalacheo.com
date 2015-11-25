<?php

/**
 * Regresa la condicion dependiendo del slug o el id que se le pase.
 *
 * @param mixed $slug
 * @return string
 */
function article_condition($slug)
{
    $conditions = \Config::get('constants.conditions');
    foreach ($conditions as $condition) {
        if ($condition['slug'] == $slug || $condition['id'] == $slug) {
            return $condition;
        }
    }

    return null;
}

function article_status($id)
{
    $article_status = \Config::get('constants.status_article');
    return $article_status[$id];
}

function profile_picture(\App\User $user, $size = 50)
{
    switch ($user->provider) {
        case "google":
            $picture = str_replace('sz=50', "sz={$size}", $user->avatar);
            break;
        case "facebook":
            $picture = $user->avatar . "&height={$size}&width={$size}";
            break;
        default:
            $picture = Gravatar::src($user->email, $size);
    }
    return $picture;
}

/**
 * Flash helper.
 *
 * @param  string|null $message
 * @param  string|null $title
 * @return void
 */
function flash($message = null, $title = null)
{
    $flash = app('App\Http\Flash');

    if(func_num_args() == 0) {
        return $flash;
    }

    return $flash->info($message, $title);
}