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