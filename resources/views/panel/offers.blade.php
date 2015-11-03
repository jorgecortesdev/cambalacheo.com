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
        @forelse ($offers as $offer)
        <tr>   
            <td class="text-center"><img src="/image/article/{{ $offer->id }}/thumbnail" class="img-rounded"/></td>
            <td>{{ $offer->title }}</td>
            <td>{{ $offer->description }}</td>  
            <td class="text-center">
                <ul class="list-inline">
                    <li><a href="/trades/{{ $offer->id }}"><i class="fa fa-eye"></i> Ver</a></li>
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
