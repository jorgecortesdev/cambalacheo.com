@extends('layouts/admin')

@section('page_title', 'Dashboard')

@section('styles')
<link rel="stylesheet" href="{{ Cdn::asset('/build/css/morris.css') }}">
@stop

@section('footer')
<script type="text/javascript" src="{{ Cdn::asset('/build/js/morris.min.js') }}"></script>
<script type="text/javascript" src="{{ Cdn::asset('/build/js/raphael-min.js') }}"></script>
<script type="text/javascript">
    function create_graph_donut(url, element) {
        $.ajax({
            type: "GET",
            dataType: 'json',
            url: url
        }).done(function(data) {
            Morris.Donut({
                element: element,
                data: data,
                resize: true
            });
        }).fail(function() {
            alert( "error occured" );
        });
    }

    function create_graph_bar(url, element) {
        $.ajax({
            type: "GET",
            dataType: 'json',
            url: url
        }).done(function(data) {
            Morris.Bar({
                element: element,
                data: data,
                xkey: 'label',
                xLabelFormat: function(x) {
                    var label = x.label;
                    if (label.length > 9)
                        label = label.substr(0, 9) + '..';
                    return label;
                },
                ykeys: ['value'],
                labels: ['Value'],
                barSizeRatio: 0.4,
                xLabelAngle: 90,
                hideHover: 'auto',
                resize: true
            });
        }).fail(function() {
            alert( "error occured" );
        });
    }
    create_graph_donut('/admin/stats/images-mimes', 'images-donut-chart');
    create_graph_donut('/admin/stats/users-providers', 'users-providers-donut-chart');
    create_graph_donut('/admin/stats/articles-conditions', 'articles-conditions-donut-chart');
    create_graph_donut('/admin/stats/articles-statuses', 'articles-statuses-donut-chart');
    create_graph_donut('/admin/stats/offers-statuses', 'offers-statuses-donut-chart');

    create_graph_bar('/admin/stats/articles-categories', 'articles-categories-bar-chart');
    create_graph_bar('/admin/stats/users-states', 'users-states-bar-chart');
</script>
@stop

@section('content')

<br>
<div class="col-md-12">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-offset-1 col-md-2">
            @include('partials.admin.panel_total', [
                'type'  => 'primary',
                'count' => $users_count,
                'title' => 'Total de usuarios',
                'icon'  => 'users',
                'url'   => '/admin/users'
            ])
        </div>
        <div class="col-xs-12 col-sm-6 col-md-2">
            @include('partials.admin.panel_total', [
                'type'  => 'green',
                'count' => $articles_count,
                'title' => 'Total de artículos',
                'icon'  => 'newspaper-o',
                'url'   => '/admin/articles'
            ])
        </div>
        <div class="col-xs-12 col-sm-6 col-md-2">
            @include('partials.admin.panel_total', [
                'type'  => 'yellow',
                'count' => $questions_count,
                'title' => 'Total de preguntas',
                'icon'  => 'question-circle',
                'url'   => '#'
            ])
        </div>
        <div class="col-xs-12 col-sm-6 col-md-2">
            @include('partials.admin.panel_total', [
                'type'  => 'red',
                'count' => $offers_count,
                'title' => 'Total de ofertas',
                'icon'  => 'bullhorn',
                'url'   => '#'
            ])
        </div>
        <div class="col-xs-12 col-sm-6 col-md-2">
            @include('partials.admin.panel_total', [
                'type'  => 'purple',
                'count' => $images_count,
                'title' => 'Total de imágenes',
                'icon'  => 'picture-o',
                'url'   => '/admin/images'
            ])
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-offset-1 col-md-5">
            @include('partials.admin.panel_graph_dashboard', [
                'id'    => 'users-states-bar-chart',
                'title' => 'Usuarios por estados'
            ])
        </div>
        <div class="col-xs-12 col-sm-6 col-md-5">
            @include('partials.admin.panel_graph_dashboard', [
                'id'    => 'articles-categories-bar-chart',
                'title' => 'Artículos por categoría'
            ])
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-offset-1 col-md-2">
            @include('partials.admin.panel_graph_dashboard', [
                'id'    => 'users-providers-donut-chart',
                'title' => 'Usuarios por proveedor'
            ])
        </div>
        <div class="col-xs-12 col-sm-6 col-md-2">
            @include('partials.admin.panel_graph_dashboard', [
                'id'    => 'articles-conditions-donut-chart',
                'title' => 'Artículos por condición'
            ])
        </div>
        <div class="col-xs-12 col-sm-6 col-md-2">
            @include('partials.admin.panel_graph_dashboard', [
                'id'    => 'articles-statuses-donut-chart',
                'title' => 'Artículos por status'
            ])
        </div>
        <div class="col-xs-12 col-sm-6 col-md-2">
            @include('partials.admin.panel_graph_dashboard', [
                'id'    => 'offers-statuses-donut-chart',
                'title' => 'Ofertas por status'
            ])
        </div>
        <div class="col-xs-12 col-sm-6 col-md-2">
            @include('partials.admin.panel_graph_dashboard', [
                'id'    => 'images-donut-chart',
                'title' => 'Imágenes por tipo'
            ])
        </div>
    </div>
</div>

@stop