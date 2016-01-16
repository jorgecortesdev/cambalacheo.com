@extends('layouts.master')

@section('page_title', 'Condición: ' . article_condition($articles->first()->condition_id)['name'])

@section('content')

<h4>Mostrando: <span class="text-muted">{{ article_condition($articles->first()->condition_id)['name'] }}s</span></h4>

@include('partials.articles.list')

<div class="row">
    <div class="col-md-12 text-center">{!! $articles->render() !!}</div>
</div>

@endsection