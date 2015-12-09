<div class="row">
    <div class="col-xs-12">
        <div class="row">
            <div class="col-xs-12 header">
                <div class="logo">
                    <a href="/"><img src="{{ Cdn::asset('/img/logo-md-blue.png') }}"></a>
                </div>
                <div class="follow-us hidden-xs">
                    <ul class="social">
                        <li>
                            <a class="fb" href="https://www.facebook.com/cambalacheo.oficial/" target="_blank"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li>
                            <a class="tw" href="https://twitter.com/cambalacheocom" target="_blank"><i class="fa fa-twitter"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <nav class="navbar navbar-default" role="navigation">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#cambalacheo-navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="cambalacheo-navbar">
                        <ul class="nav navbar-nav">
                            <li @if ($menu_active == 'index') class="active" @endif><a href="/"><i class="fa fa-home"></i> Inicio</a></li>
                            @if (Auth::check())
                            <li @if ($menu_active == 'panel') class="active" @endif><a href="/panel"><i class="fa fa-user"></i> Mi panel</a></li>
                            @can('admin')<li><a href="/admin"><i class="fa fa-lock"></i> Admin</a></li>@endcan
                            <li><a href="/auth/logout"><i class="fa fa-sign-out"></i> Cerrar sesión</a></li>
                            @else
                            <li @if ($menu_active == 'login') class="active" @endif><a href="/auth/login"><i class="fa fa-sign-in"></i> Entrar</a></li>
                            <li @if ($menu_active == 'register') class="active" @endif><a href="/auth/register"><i class="fa fa-user-plus"></i> Registrar</a></li>
                            @endif
                        </ul>
                        <a href="/panel/article/create" class="btn btn-article btn-add navbar-btn navbar-right hidden-xs">Publicar artículo</a>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="row visible-xs">
    <div class="col-xs-12">
        <div class="btn-add-article">
            <a href="/panel/article/create" class="btn btn-article btn-add btn-block">Publicar artículo</a>
        </div>
    </div>
</div>
