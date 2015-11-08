@extends('layouts.master')

@section('page_title', 'Publicar artículo')

@section('footer')
<script src="{{ Cdn::url('/js/edit-article.js') }}"></script>
@endsection

@section('content')
<h4>Editar artículo</h4>

<br>

{!! Form::model($article, ['route' => ['article.update', $article->id], 'method' => 'put', 'files' => true, 'class' => 'form-horizontal']) !!}
    {!! Form::hidden('redirects_to', URL::previous()) !!}

    <div class="form-group @if ($errors->has('title')) has-error @endif">
        {!! Form::label('title', 'Título', ['class' => 'col-xs-2 control-label']) !!}
        <div class="col-xs-10">
            {!! Form::text('title', null, ['class' => 'form-control']) !!}
            @if ($errors->has('title'))
            <span class="help-block">* {{ $errors->first('title') }}</span>
            @endif
        </div>
    </div>

    <div class="form-group @if ($errors->has('category_id')) has-error @endif">
        {!! Form::label('category', 'Categoría', ['class' => 'col-xs-2 control-label']) !!}
        <div class="col-xs-10">
            {!! Form::select(
                'category_id',
                ['' => '-- Seleccionar --'] + $categories->toArray(),
                null,
                ['class' => 'form-control'])
            !!}
            @if ($errors->has('category_id'))
            <span class="help-block">* {{ $errors->first('category_id') }}</span>
            @endif
        </div>
    </div>

    <div class="form-group @if ($errors->has('condition_id')) has-error @endif">
        {!! Form::label('condition', 'Condición', ['class' => 'col-xs-2 control-label']) !!}
        <div class="col-xs-10">
            {!! Form::select(
                'condition_id',
                ['' => '--Seleccionar --'] + $conditions,
                null,
                ['class' => 'form-control'])
            !!}
            @if ($errors->has('condition_id'))
            <span class="help-block">* {{ $errors->first('condition_id') }}</span>
            @endif
        </div>
    </div>

    <div class="form-group @if ($errors->has('description')) has-error @endif">
        {!! Form::label('description', 'Descripción', ['class' => 'col-xs-2 control-label']) !!}
        <div class="col-xs-10">
            {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 3]) !!}
            @if ($errors->has('description'))
            <span class="help-block">* {{ $errors->first('description') }}</span>
            @endif
        </div>
    </div>

    <div class="form-group @if ($errors->has('request')) has-error @endif">
        {!! Form::label('request', 'Cambio por', ['class' => 'col-xs-2 control-label']) !!}
        <div class="col-xs-10">
            {!! Form::text('request', null, ['class' => 'form-control']) !!}
            @if ($errors->has('request'))
            <span class="help-block">* {{ $errors->first('request') }}</span>
            @endif
        </div>
    </div>

    <br>
    <div class="row xs-hidden">
        <div class="col-xs-offset-2 col-xs-10">
            <ul class="list-inline">
                @foreach ($article->images as $image)
                <li>
                    <div class="text-center">
                        <div class="myImageWrapper">
                            <img data-image-id="{{ $image->id }}" src="{{ Cdn::url('/image/article/' . $article->id . '/' . $image->id . '/list', 'image') }}" class="img-thumbnail myImage">
                        </div>
                        <br>
                        <a class="remove-image" href="#"><span><i class="fa fa-trash"></i> Remover</span></a>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="row xs-hidden">
        <div class="col-xs-offset-2 col-xs-10">
            <span class="help-block">* Para remover una imágen, presiona "Remover", al finalizar presiona el botón "Guardar".</span>
        </div>
    </div>
    <br>

    {{--*/ $image_error_message = ''; /*--}}
    @foreach ($errors->toArray() as $key => $error)
        @if (strpos($key, 'image') !== false)
            {{--*/
                $image_error_message = array_shift($error);
                break;
            /*--}}
        @endif
    @endforeach
    <div class="form-group @if (!empty($image_error_message)) has-error @endif">
        {!! Form::label('image', 'Imágen', ['class' => 'col-xs-2 control-label']) !!}
        <div class="col-xs-10">
            {!! Form::file('image[]', ['multiple' => true]) !!}
            <span class="help-block">* Formatos aceptados jpeg, png y gif. Tamaño máximo 2Mb.</span>
            @if (!empty($image_error_message))
            <span class="help-block">* {{ $image_error_message }}</span>
            @endif
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-offset-2 col-xs-10">
            <ul class="list-inline pull-right">
                <li>{!! Form::button('Guardar', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}</li>
                <li><a class="btn btn-primary" href="{{ URL::previous() }}">Cancelar</a></li>
            </ul>
        </div>
    </div>

{!! Form::close() !!}

@endsection
