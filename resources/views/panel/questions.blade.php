@extends('layouts.master')

@section('page_title', 'Mis preguntas')

@section('content')

<h4>Mis preguntas</h4>

<table class="table table-stripped">
    <thead>
        <tr>
            <th class="text-center">Imágen</th>
            <th class="text-center">Artículo</th>
            <th class="text-center">Pregunta</th>
            <th class="text-center">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($questions as $question)
        <tr>   
            <td class="text-center"><img src="{{ Cdn::url('/image/article/' . $question->id . '/thumbnail', 'image') }}" class="img-rounded"/></td>
            <td>{{ $question->title }}</td>
            <td>{{ $question->description }}</td>  
            <td class="text-center">
                <ul class="list-inline">
                    <li><a href="/trades/{{ $question->id }}"><i class="fa fa-eye"></i> Ver</a></li>
                </ul>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="text-center">
                <span>No hay preguntas</span>
            </td>
        </tr>
        @endforelse

    </tbody>
</table>

@endsection
