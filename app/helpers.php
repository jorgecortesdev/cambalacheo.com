<?php

/**
 * Traduce el id de la condicion del articulo al nombre.
 *
 * @param int $id
 * @return string
 */
function article_condition($id)
{
    $conditions = \Config::get('constants.conditions');
    return isset($conditions[$id]) ? $conditions[$id] : null;
}