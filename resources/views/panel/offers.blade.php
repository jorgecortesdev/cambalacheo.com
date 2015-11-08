@extends('layouts.master')

@section('page_title', 'Mis ofertas')

@section('content')

<h4>Mis ofertas</h4>

<table class="table table-stripped">
    <thead>
        <tr>
            <th class="text-center">Imágen</th>
            <th class="text-center">Artículo</th>
            <th class="text-center">Oferta</th>
            <th class="text-center">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($offers as $article)
        <tr>
            <td class="text-center">
                <img
                    class="img-rounded lazy"
                    data-original="{{ Cdn::url('/image/article/' . $article->id . '/' . $article->images->first()->id . '/thumbnail', 'image') }}"
                    src="{{ Cdn::url('/image/article/default/thumbnail.gif') }}"
                />
            </td>
            <td>{{ $article->title }}</td>
            <td>{{ $article->description }}</td>
            <td class="text-center">
                <ul class="list-inline">
                    <li><a href="/trades/{{ $article->id }}"><i class="fa fa-eye"></i> Ver</a></li>
                </ul>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="text-center">
                <span>No hay ofertas</span>
            </td>
        </tr>
        @endforelse

    </tbody>
</table>

@endsection
