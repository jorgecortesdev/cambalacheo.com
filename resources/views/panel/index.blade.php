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
                    @forelse ($received_offers as $article)
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
                    <th class="text-center">Pregunta</th>
                    <th class="text-center">Acciones</th>
                </tr>
                <tbody>
                    @forelse ($received_questions as $article)
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
