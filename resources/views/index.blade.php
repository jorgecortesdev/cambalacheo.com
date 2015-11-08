@extends('layouts.master')

@if (!empty($category))
    @section('page_title', 'Categoría: ' . $category->name)
@elseif (!empty($conditions))
    @section('page_title', 'Condición: ' . $conditions[$condition_id])
@elseif (!empty($query))
    @section('page_title', 'Resultado de buscar: ' . $query)
@elseif (!empty($location))
    @section('page_title', 'Ubicación: ' . $location->name . ', ' . $location->short)
@else
    @section('page_title', 'Inicio')
@endif

@section('content')
@if (!empty($category) || !empty($conditions) || !empty($query) || !empty($location))
{!! Breadcrumbs::render('home') !!}
@endif

@if (!empty($featured_articles))
<h4>Cambalaches destacados</h4>
<div class="row selected-classifieds">
    @foreach ($featured_articles as $article)
    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
        <div class="thumbnail">
            <a href="/trades/{{ $article->id }}">
                <img
                    class="lazy"
                    data-original="{{ Cdn::url('/image/article/' . $article->id . '/' . $article->images->first()->id . '/profile', 'image') }}"
                    src="{{ Cdn::url('/image/article/default/profile.gif') }}"
                />
            </a>
            <div class="caption">
                <h5><a href="/trades/{{ $article->id }}">{{ str_limit($article->title, 42) }}</a></h5>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif

@if (!empty($category))
<h4>Mostrando: <span class="text-muted">{{ $category->name }}</span></h4>
@elseif (!empty($conditions))
<h4>Mostrando: <span class="text-muted">{{ $conditions[$condition_id] }}s</span></h4>
@elseif (!empty($query))
<h4>Resultados de: <span class="text-muted">{{ $query }}</span></h4>
@elseif (!empty($location))
<h4>Mostrando: <span class="text-muted">{{ $location->name }}, {{ $location->short }}</span></h4>
@else
<h4>Más recientes</h4>
@endif

@include('layouts.partials.article_list')

@endsection