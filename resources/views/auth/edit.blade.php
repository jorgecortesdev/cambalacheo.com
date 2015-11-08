@extends('layouts.master')

@section('page_title', 'Editar perfil')

@section('footer')
<script src="{{ Cdn::url('/js/jquery.simplyCountable.js') }}"></script>
<script src="{{ Cdn::url('/js/user.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('select#state').change(function() {
            var state_id = $(this).val();
            loadCities(state_id, false);
        });

        $('#edit-profile-button').on('click', function () {
            var $btn = $(this).button('loading');
        });

        @if (count($errors) > 0)
            $('select#state').trigger('change');
        @endif
    });
</script>
@endsection

@section('content')
<h2>Editar perfil</h2>
<p>&iquest;Necesitas editar algún dato de tu perfil?, puedes hacerlo en esta sección. Recuerda que al editar tu ubicación todos tus anuncios publicados también cambiarán para adaptarse a tu nueva dirección.</p>

<hr>

<div class="row">
    <div class="col-md-12">
        <div class="well">
            {!! Form::model($user, ['route' => ['panel.profile', $user->id], 'method' => 'put', 'class' => 'form-counter']) !!}
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
                        <div class="col-md-6  @if ($errors->has('state_id')) has-error @endif">
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
                                ['' => '-- Seleccionar --'] + $cities->toArray(),
                                null,
                                ['class' => 'form-control', 'id' => 'city'])
                            !!}
                            @if ($errors->has('city_id'))
                            <span class="help-block">* {{ $errors->first('city_id') }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <br>
                {!! Form::button('Guardar', [
                    'class'             => 'btn btn-lg btn-primary btn-block',
                    'type'              => 'submit',
                    'data-loading-text' => '<i class="fa fa-cog fa-spin"></i> Enviando...',
                    'id'                => 'edit-profile-button'
                ]) !!}
            {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection
