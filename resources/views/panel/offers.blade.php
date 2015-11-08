@extends('layouts.master')

@section('page_title', 'Mis ofertas')

@section('content')

<h2>Ofertas</h2>
<p>Aquí puedes ver un listado de las ofertas que has enviado y las ofertas que has recibido.</p>

<hr>

<div>
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#sent" role="tab" data-toggle="tab">Enviadas <span class="badge">{{ $offers_sent->count() }}</span></a>
        </li>
        <li role="presentation">
            <a href="#received" role="tab" data-toggle="tab">Recibidas <span class="badge">{{ $offers_received->count() }}</span></a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="sent">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">Imágen</th>
                                <th class="text-center">Artículo</th>
                                <th class="text-center">Oferta</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($offers_sent as $article)
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
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="received">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">Imágen</th>
                                <th class="text-center">Artículo</th>
                                <th class="text-center">Oferta</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($offers_received as $article)
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
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
