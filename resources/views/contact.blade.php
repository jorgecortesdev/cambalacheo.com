@extends('layouts.master')

@section('page_title', 'Contacto')

@section('content')
{!! Breadcrumbs::render('home') !!}

<h2>Contáctanos</h2>
<p>Si tienes alguna duda o comentario respecto al sitio de cambalacheo.com no lo pienses dos veces, llena
la forma siguiente y mandanos un mensaje.</p>

<hr>

@if(Session::has('message'))
<div class="alert alert-info text-center">
    {{Session::get('message')}}
</div>
@endif

<div class="row">
    <div class="col-md-12">
        <div class="well">
            {!! Form::open(['url' => 'contact']) !!}
                <div class="form-group @if ($errors->has('name')) has-error @endif">
                    {!! Form::label('name', 'Nombre', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
                    @if ($errors->has('name'))
                    <span class="help-block">* {{ $errors->first('name') }}</span>
                    @endif
                </div>

                <div class="form-group @if ($errors->has('email')) has-error @endif">
                    {!! Form::label('email', 'Correo', ['class' => 'control-label']) !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                    @if ($errors->has('email'))
                    <span class="help-block">* {{ $errors->first('email') }}</span>
                    @endif
                </div>

                <div class="form-group @if ($errors->has('message')) has-error @endif">
                    {!! Form::label('message', 'Mensaje', ['class' => 'control-label']) !!}
                    {!! Form::textarea('message', null, ['class' => 'form-control', 'rows' => 5]) !!}
                    @if ($errors->has('message'))
                    <span class="help-block">* {{ $errors->first('message') }}</span>
                    @endif
                </div>

                <div class="form-group @if ($errors->has('g-recaptcha-response')) has-error @endif">
                    {!! Recaptcha::render(['lang' => 'es']) !!}
                    @if ($errors->has('g-recaptcha-response'))
                    <span class="help-block">* {{ $errors->first('g-recaptcha-response') }}</span>
                    @endif
                </div>

                <br>
                {!! Form::button('Enviar', ['class' => 'btn btn-lg btn-primary btn-block', 'type' => 'submit']) !!}
            {!! Form::close() !!}
        </div>
    </div>
</div>




@endsection