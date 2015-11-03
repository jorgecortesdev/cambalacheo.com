@extends('layouts.master')

@section('page_title', 'Entrar')

@section('content')

<div class="row">
    <br>
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Entrar</h3>
            </div>
            <div class="panel-body">
                {!! Form::open(['url' => '/auth/login']) !!}
                <fieldset>
                    <div class="form-group">
                        {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Correo']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Contraseña']) !!}
                    </div>
                    <div class="checkbox">
                        <label>
                            {!! Form::checkbox('remember', 'Remember Me') !!} No cerrar sesión
                        </label>
                    </div>
                    {!! Form::submit('Entrar', ['class' => 'btn btn-primary pull-right']) !!}
                </fieldset>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="alert alert-info" role="alert">
            <span>&iquest;No tienes cuenta aún? - <a href="/auth/register">Registrate gratis aquí</a></span>
        </div>
        
    </div>
</div>

@endsection

