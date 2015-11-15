@extends('layouts.master')

@section('page_title', 'Ubicación: ' . $location->name . ', ' . $location->short)

@section('content')

<h4>Mostrando: <span class="text-muted">{{ $location->name }}, {{ $location->short }}</span></h4>

@include('partials.articles.list')

<div class="row">
    <div class="col-md-12 text-center">{!! $articles->render() !!}</div>
</div>

@endsection