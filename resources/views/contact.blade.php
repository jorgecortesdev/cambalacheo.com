@extends('layouts.master')

@section('page_title', 'Contacto')

@section('content')

<h4 class="h-top">Contáctanos</h4>

<br>

@if(Session::has('message'))
<div class="alert alert-info">
    {{Session::get('message')}}
</div>
@endif

{!! Form::open(['url' => 'contact', 'class' => 'form-horizontal']) !!}

    <div class="form-group @if ($errors->has('name')) has-error @endif">
        {!! Form::label('name', 'Nombre', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-9">
            {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
            @if ($errors->has('name'))
            <span class="help-block">* {{ $errors->first('name') }}</span>
            @endif
        </div>
    </div>

    <div class="form-group @if ($errors->has('email')) has-error @endif">
        {!! Form::label('email', 'Correo', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-9">
            {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
            @if ($errors->has('email'))
            <span class="help-block">* {{ $errors->first('email') }}</span>
            @endif
        </div>
    </div>

    <div class="form-group @if ($errors->has('message')) has-error @endif">
        {!! Form::label('message', 'Mensaje', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-9">
            {!! Form::textarea('message', null, ['class' => 'form-control', 'rows' => 5]) !!}
            @if ($errors->has('message'))
            <span class="help-block">* {{ $errors->first('message') }}</span>
            @endif
        </div>
    </div>

    <div class="form-group @if ($errors->has('g-recaptcha-response')) has-error @endif">
        <div class="col-md-offset-3 col-md-9">
            {!! Recaptcha::render(['lang' => 'es']) !!}
            @if ($errors->has('g-recaptcha-response'))
            <span class="help-block">* {{ $errors->first('g-recaptcha-response') }}</span>
            @endif
        </div>
    </div>

<div class="form-group">
    <div class="col-md-offset-3 col-md-9">
        {!! Form::button('Enviar', ['class' => 'btn btn-primary pull-right', 'type' => 'submit']) !!}
    </div>
</div>

{!! Form::close() !!}

@endsection