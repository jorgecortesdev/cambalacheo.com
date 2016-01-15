<h4>Cambalaches destacados</h4>
<div class="row">
    <div class="col-md-12">
        <div class="featured">
            <div class="featured-items hidden-xs">
                @foreach ($featured as $article)
                    <div class="text-center">
                        <div class="featured-thumbnail">
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
            <div class="featured-items visible-xs">
                @foreach ($featured as $article)
                    <div class="text-center">
                        <div class="featured-thumbnail">
                            <a href="/articulo/{{ $article->slug }}">
                                <img
                                    class="lazy"
                                    data-original="{{ Cdn::image($article->images->first(), 'list') }}"
                                    src="{{ Cdn::asset('/image/article/default/list.gif') }}"
                                />
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@section('footer')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.featured-items').slick({
                slidesToShow: 4,
                slidesToScroll: 4,
                speed: 300,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                            speed: 300
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            centerMode: true,
                            centerPadding: '60px',
                            arrows: false,
                            slidesToShow: 4,
                            slidesToScroll: 4,
                            speed: 300,
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            centerMode: true,
                            centerPadding: '60px',
                            arrows: false,
                            slidesToShow: 2,
                            slidesToScroll: 2,
                            speed: 300,
                        }
                    }
                ]
            });
        });
    </script>
@stop