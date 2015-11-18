<h4>Cambalaches destacados</h4>
<div class="row selected-classifieds">
    @foreach ($featured_articles as $article)
    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
        <div class="thumbnail">
            <a href="/articulo/{{ $article->slug }}">
                <img
                    class="lazy"
                    data-original="{{ Cdn::image($article->images->first(), 'profile') }}"
                    src="{{ Cdn::asset('/image/article/default/profile.gif') }}"
                />
            </a>
            <div class="caption">
                <h5><a href="/articulo/{{ $article->slug }}">{{ str_limit($article->title, 42) }}</a></h5>
            </div>
        </div>
    </div>
    @endforeach
</div>