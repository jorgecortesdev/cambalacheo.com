@extends('layouts/admin')

@section('page_title', 'Artículos')

@section('content')

<div class="col-md-12">
    <table class="table table-stripped table-hover">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Imágen</th>
                <th class="text-center">Título</th>
                <th class="text-center">Descripción</th>
                <th class="text-center">Condición</th>
                <th class="text-center">Estado</th>
                <th class="text-center">Imágenes</th>
                <th class="text-center">Preguntas</th>
                <th class="text-center">Ofertas</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articles as $article)
            <tr>
                <td class="text-right">{{ $article->id }}</td>
                <td class="text-center">
                    <img
                        class="img-responsive lazy"
                        data-original="{{ Cdn::image($article->images->first(), 'thumbnail') }}"
                        src="{{ Cdn::asset('/image/article/default/thumbnail.gif') }}"
                    />
                </td>
                <td>{{ $article->title }}</td>
                <td>{{ $article->description }}</td>
                <td class="text-center">{{ article_condition($article->condition_id)['name'] }}</td>
                <td class="text-center">{{ article_status($article->status) }}</td>
                <td class="text-center">{{ $article->images->count() }}</td>
                <td class="text-center">{{ $article->questions->count() }}</td>
                <td class="text-center">{{ $article->offers->count() }}</td>
                <td class="text-center">
                    <ul class="list-inline">
                        <li><a href="/articulo/{{ $article->slug }}"><i class="fa fa-eye"></i> Ver</a></li>
                    </ul>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row">
        <div class="col-md-12 text-center">{!! $articles->render() !!}</div>
    </div>
</div>

@stop