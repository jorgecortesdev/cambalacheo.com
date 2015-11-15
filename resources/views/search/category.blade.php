@extends('layouts.master')

@section('page_title', 'Categoría: ' . $category->name)

@section('content')

<h4>Mostrando: <span class="text-muted">{{ $category->name }}</span></h4>

@include('partials.articles.list')

<div class="row">
    <div class="col-md-12 text-center">{!! $articles->render() !!}</div>
</div>

@endsection