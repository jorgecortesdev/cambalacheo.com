@extends('layouts.master')

@section('page_title', 'Resultado de buscar: ' . $query)

@section('content')

<h4>Resultados de: <span class="text-muted">{{ $query }}</span></h4>

@include('partials.articles.list')

<div class="row">
    <div class="col-md-12 text-center">
        {!! $articles->appends(['query' => $query])->render() !!}
    </div>
</div>

@endsection