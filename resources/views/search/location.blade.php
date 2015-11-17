@extends('layouts.master')

@section('page_title', 'Ubicación: ' . $location->city_name . ', ' . $location->state_short)

@section('content')

<h4>Mostrando: <span class="text-muted">{{ $location->city_name }}, {{ $location->state_short }}</span></h4>

@include('partials.articles.list')

<div class="row">
    <div class="col-md-12 text-center">{!! $articles->render() !!}</div>
</div>

@endsection