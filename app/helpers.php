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