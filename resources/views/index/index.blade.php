@extends('layouts.master')

@section('page_title', 'Inicio')

@section('content')

@if (!empty($featured))
    @include('partials.articles.featured')
@endif

<h4>Más recientes</h4>

@include('partials.articles.list')

<div class="row">
    <div class="col-md-12 text-center">{!! $articles->render() !!}</div>
</div>

@endsection