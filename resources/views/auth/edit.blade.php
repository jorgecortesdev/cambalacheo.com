@extends('layouts.master')

@section('page_title', 'Editar perfil')

@section('content')

<h4>Editar perfil</h4>

<br>

{!! Form::model($user, ['route' => ['panel.profile', $user->id], 'method' => 'put', 'class' => 'form-horizontal']) !!}

    <div class="form-group @if ($errors->has('name')) has-error @endif">
        {!! Form::label('name', 'Nombre', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-8">
            {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
            @if ($errors->has('name'))
            <span class="help-block">* {{ $errors->first('name') }}</span>
            @endif
        </div>
    </div>

    <div class="form-group @if ($errors->has('email')) has-error @endif">
        {!! Form::label('email', 'Correo', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-8">
            {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
            @if ($errors->has('email'))
            <span class="help-block">* {{ $errors->first('email') }}</span>
            @endif
        </div>
    </div>

    <div class="form-group @if ($errors->has('password')) has-error @endif">
        {!! Form::label('password', 'Contraseña', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-8">
            {!! Form::password('password', ['class' => 'form-control']) !!}
            @if ($errors->has('password'))
            <span class="help-block">* {{ $errors->first('password') }}</span>
            @endif
        </div>
    </div>

    <div class="form-group @if ($errors->has('password')) has-error @endif">
        {!! Form::label('password', 'Confirmar Contraseña', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-8">
            {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
            @if ($errors->has('password'))
            <span class="help-block">* {{ $errors->first('password') }}</span>
            @endif
        </div>
    </div>

    <div class="form-group @if ($errors->has('state_id')) has-error @endif">
        {!! Form::label('state', 'Estado', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-8">
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
    </div>

    <div class="form-group @if ($errors->has('city_id')) has-error @endif">
        {!! Form::label('city', 'Ciudad', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-8">
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

    <div class="form-group">
        <div class="col-md-offset-4 col-md-8">
            {!! Form::button('Guardar', ['class' => 'btn btn-primary pull-right', 'type' => 'submit']) !!}
        </div>
    </div>

{!! Form::close() !!}

@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('select#state').change(function() {
                var state_id = $(this).val();
                loadCitites(state_id);
            });

            @if (count($errors) > 0)
                $('select#state').trigger('change');
            @endif
        });

        function loadCitites(state_id) {
            $.ajax({
                url: '/citites/' + state_id
            }).done(function(cities) {
                var select = $('select#city');
                select.empty();
                select.append('<option value="">-- Seleccionar --</option>');
                $.each(cities.cities, function(i, item) {
                    select.append('<option value="' + item.id + '">' + item.name + '</option>');
                });
                // select.prop('disabled', false);
            });            
        }
    </script>
@endsection