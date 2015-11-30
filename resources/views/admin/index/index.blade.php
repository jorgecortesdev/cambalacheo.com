@extends('layouts/admin')

@section('page_title', 'Dashboard')

@section('styles')
<link rel="stylesheet" href="{{ Cdn::asset('/build/css/morris.css') }}">
@stop

@section('footer')
<script type="text/javascript" src="{{ Cdn::asset('/build/js/morris.min.js') }}"></script>
<script type="text/javascript" src="{{ Cdn::asset('/build/js/raphael-min.js') }}"></script>
<script type="text/javascript">
    $.ajax({
        type: "GET",
        dataType: 'json',
        url: "/admin/stats/images"
    }).done(function(data) {
        Morris.Donut({
            element: 'morris-donut-chart',
            data: data,
            resize: true
        });
    }).fail(function() {
        alert( "error occured" );
    });
</script>
@stop

@section('content')

<br>
<div class="col-md-12">
    <div class="row">
        <div class="col-lg-3 col-md-6">
            @include('partials.admin.panel_total', [
                'type'  => 'primary',
                'count' => $users_count,
                'title' => 'Total de usuarios',
                'icon'  => 'users',
                'url'   => '/admin/users'
            ])
        </div>
        <div class="col-lg-3 col-md-6">
            @include('partials.admin.panel_total', [
                'type'  => 'green',
                'count' => $articles_count,
                'title' => 'Total de artículos',
                'icon'  => 'newspaper-o',
                'url'   => '/admin/articles'
            ])
        </div>
        <div class="col-lg-3 col-md-6">
            @include('partials.admin.panel_total', [
                'type'  => 'yellow',
                'count' => $questions_count,
                'title' => 'Total de preguntas',
                'icon'  => 'question-circle',
                'url'   => '#'
            ])
        </div>
        <div class="col-lg-3 col-md-6">
            @include('partials.admin.panel_total', [
                'type'  => 'red',
                'count' => $offers_count,
                'title' => 'Total de ofertas',
                'icon'  => 'bullhorn',
                'url'   => '#'
            ])
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-md-6">
            @include('partials.admin.panel_donut', [
                'id' => 'morris-donut-chart',
                'title' => 'Imágenes'
            ])
        </div>
    </div>
</div>

@stop