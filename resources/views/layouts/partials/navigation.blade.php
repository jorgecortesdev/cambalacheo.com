<nav role="navigation" class="navbar navbar-default">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <a href="/" class="navbar-brand">Cambalacheo</a>
    </div>
    <!-- Collection of nav links, forms, and other content for toggling -->
    <div id="navbarCollapse" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
            <li @if ($menu_active == 'index') class="active" @endif><a href="/"><i class="fa fa-home"></i> Inicio</a></li>
            @if (Auth::check())
            <li @if ($menu_active == 'panel') class="active" @endif><a href="/panel"><i class="fa fa-user"></i> Mi panel</a></li>
            <li><a href="/auth/logout"><i class="fa fa-sign-out"></i> Cerrar sesión</a></li>
            @else
            <li @if ($menu_active == 'login') class="active" @endif><a href="/auth/login"><i class="fa fa-sign-in"></i> Entrar</a></li>
            <li @if ($menu_active == 'register') class="active" @endif><a href="/auth/register"><i class="fa fa-user-plus"></i> Registrar</a></li>
            @endif
        </ul>

        <ul class="nav navbar-nav navbar-right">
        {!! Form::open(['url' => '/search', 'class' => 'navbar-form navbar-left', 'method' => 'get']) !!}
            <div class="input-group">
                {!! Form::text('q', null, ['class' => 'form-control', 'placeholder' => 'Busca por...']) !!}
                <span class="input-group-btn">
                    {!! Form::button('<i class="fa fa-search"></i>', ['class' => 'btn btn-default', 'type' => 'submit']) !!}
                </span>
            </div><!-- /input-group -->
        {!! Form::close() !!}
        </ul>
    </div>
</nav>
