@extends('layouts.master')

@section('page_title', 'Entrar')

@section('content')
{!! Breadcrumbs::render('home') !!}

<h2>Entrar</h2>
<p>Introduce tus datos para entrar en el sitio. Si aún no estas registrado, puedes hacerlo totalmente <strong>gratis</strong> <a href="/auth/register">aquí</a>.</p>

<hr>

<div class="row">
    <div class="col-md-12">
        <div class="well">
            {!! Form::open(['url' => '/auth/login']) !!}
                <div class="form-group @if ($errors->has('email')) has-error @endif">
                    {!! Form::label('email', 'Correo', ['class' => 'control-label']) !!}
                    {!! Form::email('email', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('email'))
                    <span class="help-block">* {{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="form-group @if ($errors->has('password')) has-error @endif">
                    {!! Form::label('password', 'Contraseña', ['class' => 'control-label']) !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                    @if ($errors->has('password'))
                    <span class="help-block">* {{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="checkbox">
                    <label>
                        {!! Form::checkbox('remember', 'Remember Me') !!} No cerrar sesión
                    </label>
                </div>
                <br>
                {!! Form::submit('Entrar', ['class' => 'btn btn-lg btn-primary btn-block']) !!}
            {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection

