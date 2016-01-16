@extends('layouts.master')

@section('page_title', 'Ubicación: ' . $articles->first()->user->city->name . ', ' . $articles->first()->user->state->short)

@section('content')

<h4>Mostrando: <span class="text-muted">{{ $articles->first()->user->city->name }}, {{ $articles->first()->user->state->short }}</span></h4>

@include('partials.articles.list')

<div class="row">
    <div class="col-md-12 text-center">{!! $articles->render() !!}</div>
</div>

@endsection