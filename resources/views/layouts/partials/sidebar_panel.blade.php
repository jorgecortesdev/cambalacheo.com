
<button type="button" class="visible-xs btn btn-primary offcanvas-toggle pull-right" data-toggle="offcanvas" data-target="#js-bootstrap-offcanvas">
    Menu
</button>
<nav class="navbar navbar-default navbar-offcanvas navbar-offcanvas-touch navbar-offcanvas-fade" role="navigation"  id="js-bootstrap-offcanvas">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <br>
                    <div class="row text-center">
                        <div class="col-md-12">
                            <img class="img-rounded" src="{{ profile_picture(Auth::user(), 92) }}" alt="">
                            <h5>{{ Auth::user()->name }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-offset-1 col-md-10">
                    <div class="list-group">
                        <a href="/panel" class="list-group-item  @if ($menu_active == 'articles') active @endif">
                            <i class="fa fa-th"></i>&nbsp;&nbsp;Panel
                        </a>
                        <a href="/panel/offers" class="list-group-item  @if ($menu_active == 'offers') active @endif">
                            <i class="fa fa-bullhorn"></i>&nbsp;&nbsp;Ofertas
                        </a>
                        <a href="/panel/questions" class="list-group-item  @if ($menu_active == 'questions') active @endif">
                            <i class="fa fa-question"></i>&nbsp;&nbsp;Preguntas
                        </a>
                        <a href="/panel/profile" class="list-group-item  @if ($menu_active == 'profile') active @endif">
                            <i class="fa fa-user"></i>&nbsp;&nbsp;Editar perfil
                        </a>
                        <a href="/panel/article/create" class="list-group-item  @if ($menu_active == 'create') active @endif">
                            <i class="fa fa-plus"></i>&nbsp;&nbsp;Publicar artículo
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
