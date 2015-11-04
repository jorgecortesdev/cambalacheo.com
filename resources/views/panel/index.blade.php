@extends('layouts.master')

@section('page_title', 'Mi panel')

@section('content')

<div class="row dashboard">
    <div class="col-md-offset-1 col-md-5">
        <div class="main-box info-box bg-primary">
            <i class="fa fa-check-circle"></i>
            <span class="headline">Ofertas recibidas</span>
            <span class="value">{{ $received_offers->count() }}</span>
        </div>
    </div>

    <div class="col-md-5">
        <div class="main-box info-box bg-primary">
            <i class="fa fa-question-circle"></i>
            <span class="headline">Preguntas recibidas</span>
            <span class="value">{{ $received_questions->count() }}</span>
        </div>
    </div>
</div>

<br>

<div class="row">
    <div class="col-md-12">
        <h4>Ofertas recibidas</h4>
        <table class="table">
            <thead>
                <tr>
                    <th class="text-center">Imágen</th>
                    <th class="text-center">Artículo</th>
                    <th class="text-center">Oferta</th>
                    <th class="text-center">Acciones</th>
                </tr>
                <tbody>
                    @forelse ($received_offers as $offer)
                    <tr>   
                        <td class="text-center"><img src="{{ Cdn::url('/image/article/' . $offer->article_id . '/thumbnail', 'image') }}" class="img-rounded"/></td>
                        <td>{{ $offer->title }}</td>
                        <td>{{ $offer->description }}</td>  
                        <td class="text-center">
                            <ul class="list-inline">
                                <li><a href="/trades/{{ $offer->article_id }}"><i class="fa fa-eye"></i> Ver</a></li>
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
            </thead>
        </table>
    </div>
</div>

<br>

<div class="row">
    <div class="col-md-12">
        <h4>Preguntas recibidas</h4>
        <table class="table">
            <thead>
                <tr>
                    <th class="text-center">Imágen</th>
                    <th class="text-center">Artículo</th>
                    <th class="text-center">Oferta</th>
                    <th class="text-center">Acciones</th>
                </tr>
                <tbody>
                    @forelse ($received_questions as $question)
                    <tr>   
                        <td class="text-center"><img src="{{ Cdn::url('/image/article/' . $question->article_id . '/thumbnail', 'image') }}" class="img-rounded"/></td>
                        <td>{{ $question->title }}</td>
                        <td>{{ $question->description }}</td>  
                        <td class="text-center">
                            <ul class="list-inline">
                                <li><a href="/trades/{{ $question->article_id }}"><i class="fa fa-eye"></i> Ver</a></li>
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
            </thead>
        </table>
    </div>
</div>
@endsection
