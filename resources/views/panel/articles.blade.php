@extends('layouts.master')

@section('page_title', 'Mis artículos')

@section('footer')
<script type="text/javascript" src="{{ Cdn::url('/js/article.js') }}"></script>
@endsection

@section('content')

<h4>Mis artículos</h4>

<table class="table table-stripped">
    <thead>
        <tr>
            <th class="text-center">Imágen</th>
            <th class="text-center">Artículo</th>
            <th class="text-center">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($articles as $article)
        <tr>   
            <td class="text-center"><img src="{{ Cdn::url('/image/article/' . $article->id . '/thumbnail', 'image') }}" class="img-rounded"/></td>
            <td>{{ $article->title }}</td>
            <td class="text-center">
                <ul class="list-inline">
                    <li><a href="/trades/{{ $article->id }}"><i class="fa fa-eye"></i> Ver</a></li>
                    <li><a href="/panel/articles/edit/{{ $article->id }}"><i class="fa fa-edit"></i> Editar</a></li>
                    <li><a href="#" data-id="{{ $article->id }}" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i> Remover</a></li>
                </ul>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="text-center">
                <span>No hay artículos</span>
            </td>
        </tr>
        @endforelse

    </tbody>
</table>

<div class="row">
    <div class="col-md-12 text-center">{!! $articles->render() !!}</div>
</div>

<!-- Modal -->
<div class="modal fade" id="removeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Remover</h4>
            </div>
            {!! Form::open(['url' => 'panel/articles/update_status', 'class' => 'form-horizontal']) !!}
            {!! Form::hidden('article_id', '') !!}
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <p>Por favor indicanos la razón por la cual deseas remover este artículo de nuestro sistema?</p>
                        <br>
                        <div class="form-group">
                            {!! Form::label('reasons', 'Razón', ['class' => 'col-xs-2 control-label']) !!}
                            <div class="col-xs-10">
                                {!! Form::select(
                                    'status', 
                                    ['' => '-- Seleccionar --'] + $reasons, 
                                    null, 
                                    ['class' => 'form-control']) 
                                !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection
