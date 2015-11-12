@extends('layouts.master')

@section('page_title', 'Recuperar contraseña')

@section('footer')
<script type="text/javascript">
    $(document).ready(function () {
        $('#reset-button').on('click', function () {
            var $btn = $(this).button('loading');
        });
    });
</script>
@endsection

@section('content')
{!! Breadcrumbs::render('home') !!}

<h2>Recuperar contraseña</h2>
<p>Introduce el correo electrónico con el cual te registraste, se te enviará un correo con
una dirección donde podrás ingresar una nueva contraseña, esta dirección será válida solo
una hora, si pasado este tiempo no has ingresado una nueva contraseña tendrás que iniciar el
proceso nuevamente.</p>

<hr>

@if(Session::has('status'))
<div class="alert alert-info text-center">
    {{Session::get('status')}}
</div>
@endif

<div class="row">
    <div class="col-md-12">
        <div class="well">
            {!! Form::open(['url' => '/password/email']) !!}
                <div class="form-group @if ($errors->has('email')) has-error @endif">
                    {!! Form::label('email', 'Correo', ['class' => 'control-label']) !!}
                    {!! Form::email('email', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('email'))
                    <span class="help-block">* {{ $errors->first('email') }}</span>
                    @endif
                </div>

                <br>
                {!! Form::button('Enviar', [
                    'class'             => 'btn btn-lg btn-primary btn-block',
                    'type'              => 'submit',
                    'data-loading-text' => '<i class="fa fa-cog fa-spin"></i> Enviando...',
                    'id'                => 'reset-button'
                ]) !!}
            {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection