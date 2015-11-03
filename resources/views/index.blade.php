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

@if (!empty($category))
<h4 class="h-top">Artículos en: {{ $category->name }}</h4>
@elseif (!empty($conditions))
<h4 class="h-top">Artículos: {{ $conditions[$condition_id] }}s</h4>
@elseif (!empty($query))
<h4 class="h-top">Buscaste: {{ $query }}</h4>
@elseif (!empty($location))
<h4 class="h-top">Arículos en: {{ $location->name }}, {{ $location->short }}</h4>
@else
<h4 class="h-top">Artículos más recientes</h4>
@endif

@include('layouts.partials.article_list')

@endsection