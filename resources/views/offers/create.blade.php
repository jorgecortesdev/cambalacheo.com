@extends('layouts.master')

@section('page_title', 'Hacer oferta')


@section('content')
{!! Breadcrumbs::render('article', $article) !!}

<h4>Hacer oferta</h4>

<div class="row summary">
    <div class="col-md-2">
        <img class="img-rounded" src="{{ Cdn::image($article->images->first(), 'list') }}" alt="">
    </div>
    <div class="col-md-10">
        <dl class="dl-horizontal">
            <dt>Título</dt>
            <dd>{{ $article->title }}</dd>
            <dt>Descripión</dt>
            <dd>{{ $article->description}}</dd>
        </dl>
    </div>
</div>

{!! Form::open(['url' => 'trades/offer']) !!}

    {!! Form::hidden('article_id', $article->id) !!}
    <hr>
    <div class="form-group @if ($errors->has('description')) has-error @endif">
    	{!! Form::label('description', 'Oferta', ['class' => 'control-label']) !!}
    	{!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 3]) !!}
        @if ($errors->has('description'))
            <span class="help-block">* {{ $errors->first('description') }}</span>
        @endif
    </div>

    {!! Form::button('Agregar', ['class' => 'btn btn-primary pull-right', 'type' => 'submit']) !!}

{!! Form::close() !!}

@endsection
