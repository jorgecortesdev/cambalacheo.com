<div class="logo"><a href="/"><img src="{{ Cdn::asset('/img/logo-md-blue.png') }}"></a></div>
<nav class="navbar navbar-default" role="navigation">
    <div class="collapse navbar-collapse">
        <a href="/panel/article/create" class="btn btn-success navbar-btn navbar-left add-classified-btn" role="button">Publicar artículo</a>
        <ul class="nav navbar-nav navbar-right">
            <li @if ($menu_active == 'index') class="active" @endif><a href="/"><i class="fa fa-home"></i> Inicio</a></li>
            @if (Auth::check())
            <li @if ($menu_active == 'panel') class="active" @endif><a href="/panel"><i class="fa fa-user"></i> Mi panel</a></li>
            <li><a href="/auth/logout"><i class="fa fa-sign-out"></i> Cerrar sesión</a></li>
            @else
            <li @if ($menu_active == 'login') class="active" @endif><a href="/auth/login"><i class="fa fa-sign-in"></i> Entrar</a></li>
            <li @if ($menu_active == 'register') class="active" @endif><a href="/auth/register"><i class="fa fa-user-plus"></i> Registrar</a></li>
            @endif
        </ul>
    </div>
</nav>