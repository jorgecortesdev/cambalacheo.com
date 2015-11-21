@extends('layouts.master')

@section('page_title', 'Registrar')

@section('footer')
<script src="{{ Cdn::asset('/js/user.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('select#state').change(function() {
            var state_id = $(this).val();

            if (state_id != null && state_id != "") {
                @if (count($errors) > 0)
                    loadCities(state_id, true, function() {
                        $('select#city option[value="{{ old('city_id') }}"]').prop('selected', true);
                    });
                @else
                    loadCities(state_id, true);
                @endif
            }
        });

        $('#register-button').on('click', function () {
            var $btn = $(this).button('loading');
        });

        @if (count($errors) > 0)
            $('select#state').trigger('change');
            $('select#city option[value="{{ old('city_id') }}"]').prop('selected', true);
        @endif
    });

</script>
@endsection


@section('content')
{!! Breadcrumbs::render('home') !!}

<h2>Registrar</h2>
<p>Registrate de manera <strong>gratuita</strong> y comienza a publicar tus cambalaches inmediatamente, no tienes limite de anuncios a publicar, o si prefieres, puedes
ofertar a cambalaches ya abiertos.</p>

<hr>

<div class="row">
    <div class="col-md-12">
        <div class="well">
            {!! Form::open(['url' => '/auth/register', 'class' => 'form-counter', 'novalidate' => 'novalidate']) !!}
                <div class="form-group @if ($errors->has('name')) has-error @endif">
                    {!! Form::label('name', 'Nombre', ['class' => 'control-label']) !!}
                    <div class="input-counter">
                        {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
                        <div class="small"><span id="counter-name"></span>/255</div>
                    </div>
                    @if ($errors->has('name'))
                    <span class="help-block">* {{ $errors->first('name') }}</span>
                    @endif
                </div>

                <div class="form-group @if ($errors->has('email')) has-error @endif">
                    {!! Form::label('email', 'Correo', ['class' => 'control-label']) !!}
                    <div class="input-counter">
                        {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                        <div class="small"><span id="counter-email"></span>/255</div>
                    </div>
                    @if ($errors->has('email'))
                    <span class="help-block">* {{ $errors->first('email') }}</span>
                    @endif
                </div>

                <div class="form-group @if ($errors->has('password')) has-error @endif">
                    {!! Form::label('password', 'Contraseña', ['class' => 'control-label']) !!}
                    <div class="input-counter">
                        {!! Form::password('password', ['class' => 'form-control']) !!}
                        <div class="small"><span id="counter-password"></span>/60</div>
                    </div>
                    @if ($errors->has('password'))
                    <span class="help-block">* {{ $errors->first('password') }}</span>
                    @endif
                </div>

                <div class="form-group @if ($errors->has('password')) has-error @endif">
                    {!! Form::label('password', 'Confirmar Contraseña', ['class' => 'control-label']) !!}
                    <div class="input-counter">
                        {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                        <div class="small"><span id="counter-confirmation"></span>/60</div>
                    </div>
                    @if ($errors->has('password'))
                    <span class="help-block">* {{ $errors->first('password') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6 @if ($errors->has('state_id')) has-error @endif">
                            {!! Form::label('state', 'Estado', ['class' => 'control-label']) !!}
                            {!! Form::select(
                                'state_id',
                                ['' => '-- Seleccionar --'] + $states->toArray(),
                                null,
                                ['class' => 'form-control', 'id' => 'state'])
                            !!}
                            @if ($errors->has('state_id'))
                            <span class="help-block">* {{ $errors->first('state_id') }}</span>
                            @endif
                        </div>
                        <div class="col-md-6 @if ($errors->has('city_id')) has-error @endif">
                            {!! Form::label('city', 'Ciudad', ['class' => 'control-label']) !!}
                            {!! Form::select(
                                'city_id',
                                ['' => '-- Seleccionar --'],
                                old('city_id'),
                                ['class' => 'form-control', 'id' => 'city', 'disabled' => 'disabled'])
                            !!}
                            @if ($errors->has('city_id'))
                            <span class="help-block">* {{ $errors->first('city_id') }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <br>
                {!! Form::button('Registrar', [
                    'class'             => 'btn btn-lg btn-primary btn-block',
                    'type'              => 'submit',
                    'data-loading-text' => '<i class="fa fa-cog fa-spin"></i> Enviando...',
                    'id'                => 'register-button'
                ]) !!}
            {!! Form::close() !!}
        </div>
    </div>
</div>
<br><br>
<div class="row">
    <div class="col-md-offset-1 col-md-10 text-center">
        <p>O si lo prefieres, también puedes acceder a través de tu cuenta de Facebook o Google.</p>
    </div>
</div>
<div class="row">
    <div class="col-md-offset-1 col-md-5">
        <a class="btn btn-lg btn-primary btn-block btn-social btn-facebook" href="{{ url('auth/facebook') }}"><span class="fa fa-facebook"></span> Entrar con Facebook</a>
    </div>
    <div class="col-md-5">
        <a class="btn btn-lg btn-primary btn-block btn-social btn-google" href="{{ url('auth/google') }}"><span class="fa fa-google"></span> Entrar con Google</a>
    </div>
</div>

@endsection
