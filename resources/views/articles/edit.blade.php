@extends('layouts.master')

@section('page_title', 'Publicar artículo')

@section('footer')
<script src="{{ Cdn::url('/js/jquery.simplyCountable.js') }}"></script>
<script src="{{ Cdn::url('/js/edit-article.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#edit-article-button').on('click', function () {
            var $btn = $(this).button('loading');
        });
    });
</script>
@endsection

@section('content')
<h2>Editar artículo</h2>
<p>Aquí puedes editar la información de un artículo, para remover una imágen da clic en "Remover" debajo de la que deseas eliminar y despues en el botón guardar. Recuerda que es necesario que al menos exista una imágen.</p>

<hr>

<div class="row">
    <div class="col-md-12">
        <div class="well">
            {!! Form::model($article, ['route' => ['article.update', $article->id], 'method' => 'put', 'files' => true, 'class' => 'form-counter']) !!}
                {!! Form::hidden('redirects_to', URL::previous()) !!}

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
                <br>
                <div class="row md-hidden">
                    <div class="col-md-12">
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
                <div class="row md-hidden">
                    <div class="col-md-12">
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
                    {!! Form::label('image', 'Imágen', ['class' => 'control-label']) !!}
                    {!! Form::file('image[]', ['multiple' => true]) !!}
                    <span class="help-block">* Formatos aceptados jpeg, png y gif. Tamaño máximo 2Mb.</span>
                    @if (!empty($image_error_message))
                    <span class="help-block">* {{ $image_error_message }}</span>
                    @endif
                </div>

                <br>
                <div class="row">
                    <div class="col-md-6">
                        {!! Form::button('Guardar', [
                            'class'             => 'btn btn-lg btn-primary btn-block',
                            'type'              => 'submit',
                            'data-loading-text' => '<i class="fa fa-cog fa-spin"></i> Enviando...',
                            'id'                => 'edit-article-button'
                        ]) !!}
                    </div>
                    <div class="col-md-6">
                        <a class="btn btn-lg btn-primary btn-block" href="{{ URL::previous() }}">Cancelar</a>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection
