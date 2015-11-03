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
        <ul class="nav nav-pills nav-stacked">
            <li role="presentation" @if ($menu_active == 'index') class="active" @endif>
            <a href="/panel"><i class="fa fa-th"></i> Mi panel</a>
            </li>
            <li role="presentation" @if ($menu_active == 'articles') class="active" @endif>
            <a href="/panel/articles"><i class="fa fa-repeat"></i> Mis artículos <span class="badge">{{ $number_articles }}</span></a>
            </li>
            <li role="presentation" @if ($menu_active == 'offers') class="active" @endif>
            <a href="/panel/offers"><i class="fa fa-check"></i> Ofertas enviadas<span class="badge">{{ $number_offers }}</span></a>
            </li>
            <li role="presentation" @if ($menu_active == 'questions') class="active" @endif>
            <a href="/panel/questions"><i class="fa fa-question"></i></i> Preguntas enviadas<span class="badge">{{ $number_questions }}</span></a>
            </li>
            <li role="presentation" @if ($menu_active == 'profile') class="active" @endif>
            <a href="/panel/profile"><i class="fa fa-user"></i> Editar perfil</a>
            </li>
            <li role="presentation" @if ($menu_active == 'create') class="active" @endif>
            <a href="/panel/article/create"><i class="fa fa-plus"></i> Publicar artículo</a>
            </li>
        </ul>
    </div>
</div>
