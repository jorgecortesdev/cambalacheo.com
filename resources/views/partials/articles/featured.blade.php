<h4>Cambalaches aleatorios</h4>
<div class="row selected-classifieds">
    @foreach ($featured_articles as $article)
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 text-center">
        <div class="thumbnail">
            <a href="/articulo/{{ $article->slug }}">
                <img
                    class="lazy"
                    data-original="{{ Cdn::image($article->images->first(), 'profile') }}"
                    src="{{ Cdn::asset('/image/article/default/profile.gif') }}"
                />
            </a>
            <div class="caption">
                <h5><a href="/articulo/{{ $article->slug }}">{{ str_limit($article->title, 17) }}</a></h5>
            </div>
        </div>
    </div>
    @endforeach
</div>