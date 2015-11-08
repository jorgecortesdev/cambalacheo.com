<?php

// Home
Breadcrumbs::register('home', function($breadcrumb) {
    $breadcrumb->push('Inicio', url('/'));
});

// Home > Category
Breadcrumbs::register('category', function($breadcrumb, $category) {
    $breadcrumb->parent('home');
    $breadcrumb->push($category->name, url('/category/' . $category->id));
});

// Home > Category > Article
Breadcrumbs::register('article', function($breadcrumb, $article) {
    $breadcrumb->parent('category', $article->category);
    $breadcrumb->push($article->title, url('/trades/' . $article->id));
});