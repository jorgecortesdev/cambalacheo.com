@extends('layouts.master')

@section('page_title', 'Registrar')

@section('content')

<h4 class="h-top">Registrar</h4>

<br>

{!! Form::open(['url' => '/auth/register', 'class' => 'form-horizontal']) !!}

    <div class="form-group">
        {!! Form::label('name', 'Nombre', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-9">
            {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('email', 'Correo', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-9">
            {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('password', 'Contraseña', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-9">
            {!! Form::password('password', ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('password', 'Confirmar Contraseña', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-9">
            {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group @if ($errors->has('state_id')) has-error @endif">
        {!! Form::label('state', 'Estado', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-9">
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
        {!! Form::label('city', 'Ciudad', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-9">
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

    <div class="form-group">
        <div class="col-md-offset-3 col-md-9">
            {!! Form::button('Registrar', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
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

            // $('select#state').trigger('change');
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
                select.prop('disabled', false);
            });            
        }
    </script>
@endsection