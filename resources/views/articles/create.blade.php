@extends('layouts.master')

@section('page_title', 'Publicar artículo')

@section('footer')
<script src="{{ Cdn::url('/js/jquery.simplyCountable.js') }}"></script>
<script src="{{ Cdn::url('/js/create-article.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#create-article-button').on('click', function () {
            var $btn = $(this).button('loading');
        });
    });
</script>
@endsection


@section('content')
<h2>Publicar artículo</h2>
<p>Puedes publicar cuantos artículos o servicios desees, no tienes ningún limite. Sé creativo al momento de publicar un anuncio y recuerda que aunque tu pienses que no sirve puede ser que a alguien si le sirva.</p>

<hr>

<div class="row">
    <div class="col-md-12">
        <div class="well">
            {!! Form::open(['url' => 'articles', 'files' => true, 'class' => 'form-counter']) !!}
                <div class="form-group @if ($errors->has('title')) has-error @endif">
                    {!! Form::label('title', 'Título', ['class' => 'control-label']) !!}
                    <div class="input-counter">
                        {!! Form::text('title', null, ['class' => 'form-control']) !!}
                        <div class="small"><span id="counter-title"></span>/255</div>
                    </div>
                    @if ($errors->has('title'))
                    <span class="help-block">* {{ $errors->first('title') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6 @if ($errors->has('category_id')) has-error @endif">
                            {!! Form::label('category', 'Categoría', ['class' => 'control-label']) !!}
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
                        <div class="col-md-6 @if ($errors->has('condition_id')) has-error @endif">
                            {!! Form::label('condition', 'Condición', ['class' => 'control-label']) !!}
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
                </div>

                <div class="form-group @if ($errors->has('description')) has-error @endif">
                    {!! Form::label('description', 'Descripción', ['class' => 'control-label']) !!}
                    <div class="input-counter">
                        {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 3]) !!}
                        <div class="small"><span id="counter-description"></span>/255</div>
                    </div>
                    @if ($errors->has('description'))
                    <span class="help-block">* {{ $errors->first('description') }}</span>
                    @endif
                </div>

                <div class="form-group @if ($errors->has('request')) has-error @endif">
                    {!! Form::label('request', 'Cambio por', ['class' => 'control-label']) !!}
                    <div class="input-counter">
                        {!! Form::text('request', null, ['class' => 'form-control']) !!}
                        <div class="small"><span id="counter-request"></span>/255</div>
                    </div>
                    @if ($errors->has('request'))
                    <span class="help-block">* {{ $errors->first('request') }}</span>
                    @endif
                </div>

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
                    {!! Form::label('image', 'Imágen', ['class' => 'control-label']) !!}
                    {!! Form::file('image[]', ['multiple' => true]) !!}
                    <span class="help-block">* Formatos aceptados jpeg, png y gif. Tamaño máximo 2Mb.</span>
                    @if (!empty($image_error_message))
                    <span class="help-block">* {{ $image_error_message }}</span>
                    @endif
                </div>

                <br>
                {!! Form::button('Agregar', [
                    'class'             => 'btn btn-lg btn-primary btn-block',
                    'type'              => 'submit',
                    'data-loading-text' => '<i class="fa fa-cog fa-spin"></i> Enviando...',
                    'id'                => 'create-article-button'
                ]) !!}
            {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection
