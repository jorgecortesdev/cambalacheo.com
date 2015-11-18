<?php

// Home
Breadcrumbs::register('home', function($breadcrumb) {
    $breadcrumb->push('Inicio', url('/'));
});

// Home > Category
Breadcrumbs::register('category', function($breadcrumb, $category) {
    $breadcrumb->parent('home');
    $breadcrumb->push($category->name, url('/categoria/' . $category->slug));
});

// Home > Category > Article
Breadcrumbs::register('article', function($breadcrumb, $article) {
    $breadcrumb->parent('category', $article->category);
    $breadcrumb->push($article->title, url('/articulo/' . $article->slug));
});