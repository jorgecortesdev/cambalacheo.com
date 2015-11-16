@extends('layouts.master')

@section('page_title', 'Contacto')

@section('footer')
<script src="{{ Cdn::asset('/js/contact.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#send-contact-button').on('click', function () {
            var $btn = $(this).button('loading');
        });
    });
</script>
@endsection

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

{{--*/
$extra_attributes = [];
$name             = '';
$email            = '';
$registered       = false;
/*--}}
@if (Auth::check())
{{--*/
$name                         = Auth::user()->name;
$email                        = Auth::user()->email;
$extra_attributes['readonly'] = 'readonly';
$registered                   = true;
/*--}}
@endif

<div class="row">
    <div class="col-md-12">
        <div class="well">
            {!! Form::open(['url' => 'contact', 'class' => 'form-counter']) !!}
                {!! Form::hidden('user_registered', $user_registered) !!}

                <div class="form-group @if ($errors->has('name')) has-error @endif">
                    {!! Form::label('name', 'Nombre', ['class' => 'control-label']) !!}
                    <div class="input-counter">
                        {!! Form::text('name', $name, ['class' => 'form-control'] + $extra_attributes) !!}
                        <div class="small"><span id="counter-name"></span>/255</div>
                    </div>
                    @if ($errors->has('name'))
                    <span class="help-block">* {{ $errors->first('name') }}</span>
                    @endif
                </div>

                <div class="form-group @if ($errors->has('email')) has-error @endif">
                    {!! Form::label('email', 'Correo', ['class' => 'control-label']) !!}
                    <div class="input-counter">
                        {!! Form::email('email', $email, ['class' => 'form-control'] + $extra_attributes) !!}
                        <div class="small"><span id="counter-email"></span>/255</div>
                    </div>
                    @if ($errors->has('email'))
                    <span class="help-block">* {{ $errors->first('email') }}</span>
                    @endif
                </div>

                <div class="form-group @if ($errors->has('message')) has-error @endif">
                    {!! Form::label('message', 'Mensaje', ['class' => 'control-label']) !!}
                    <div class="input-counter">
                        {!! Form::textarea('message', null, ['class' => 'form-control', 'rows' => 5]) !!}
                        <div class="small"><span id="counter-message"></span>/255</div>
                    </div>
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
                {!! Form::button('Enviar', [
                    'class'             => 'btn btn-lg btn-primary btn-block',
                    'type'              => 'submit',
                    'data-loading-text' => '<i class="fa fa-cog fa-spin"></i> Enviando...',
                    'id'                => 'send-contact-button'
                ]) !!}
            {!! Form::close() !!}
        </div>
    </div>
</div>




@endsection