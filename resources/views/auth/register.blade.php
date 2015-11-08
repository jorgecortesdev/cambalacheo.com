@extends('layouts.master')

@section('page_title', 'Registrar')

@section('footer')
<script src="{{ Cdn::url('/js/user.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('select#state').change(function() {
            var state_id = $(this).val();
            loadCities(state_id, true);
        });
    });

    @if (count($errors) > 0)
        $('select#state').trigger('change');
    @endif
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
            {!! Form::open(['url' => '/auth/register']) !!}
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

                <div class="form-group @if ($errors->has('password')) has-error @endif">
                    {!! Form::label('password', 'Contraseña', ['class' => 'control-label']) !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                    @if ($errors->has('password'))
                    <span class="help-block">* {{ $errors->first('password') }}</span>
                    @endif
                </div>

                <div class="form-group @if ($errors->has('password')) has-error @endif">
                    {!! Form::label('password', 'Confirmar Contraseña', ['class' => 'control-label']) !!}
                    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
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
                                null,
                                ['class' => 'form-control', 'id' => 'city', 'disabled' => 'disabled'])
                            !!}
                            @if ($errors->has('city_id'))
                            <span class="help-block">* {{ $errors->first('city_id') }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <br>
                {!! Form::button('Registrar', ['class' => 'btn btn-lg btn-primary btn-block', 'type' => 'submit']) !!}
            {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection
