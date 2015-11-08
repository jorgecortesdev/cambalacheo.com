<div class="row">
    <div class="col-md-12">
        <div class="row profile-pic-container">
            <div class="col-md-12 profile-pic">
                <img class="img-rounded" src="{{ Gravatar::src(Auth::user()->email, 92) }}" alt="">
                <h5>{{ Auth::user()->name }}</h5>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="list-group">
            <a href="/panel" class="list-group-item  @if ($menu_active == 'articles') active @endif">
                <i class="fa fa-th"></i> Panel
            </a>
            <a href="/panel/offers" class="list-group-item  @if ($menu_active == 'offers') active @endif">
                <i class="fa fa-check"></i> Ofertas
            </a>
            <a href="/panel/questions" class="list-group-item  @if ($menu_active == 'questions') active @endif">
                <i class="fa fa-question"></i></i> Preguntas
            </a>
            <a href="/panel/profile" class="list-group-item  @if ($menu_active == 'profile') active @endif">
                <i class="fa fa-user"></i> Editar perfil
            </a>
            <a href="/panel/article/create" class="list-group-item  @if ($menu_active == 'create') active @endif">
                <i class="fa fa-plus"></i> Publicar artículo
            </a>
        </div>
    </div>
</div>
