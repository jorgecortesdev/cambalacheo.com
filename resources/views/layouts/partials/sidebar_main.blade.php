<div class="row hidden-xs">
    <div class="col-md-12">
        <h4>Búsqueda</h4>
        <div class="well well-sm">
            {!! Form::open(['url' => '/search', 'method' => 'get']) !!}
            <div class="input-group @if ($errors->has('query')) has-error @endif">
                {!! Form::text('query', old('query'), ['class' => 'form-control', 'placeholder' => 'Busca por...']) !!}
                <span class="input-group-btn">
                    {!! Form::button('<i class="fa fa-search"></i>', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
                </span>
            </div>
            @if ($errors->has('q'))
            <div class="form-group has-error">
                <span class="form-group help-block">* {{ $errors->first('q') }}</span>
            </div>
            @endif
            {!! Form::close() !!}
        </div>
        <div class="hidden-sm hidden-md">
            <div class="fb-page" data-href="https://www.facebook.com/cambalacheo.oficial" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/cambalacheo.oficial"><a href="https://www.facebook.com/cambalacheo.oficial">Cambalacheo</a></blockquote></div></div>
            <h4>Categorías</h4>
            <div class="categories list-group hidden-xs hidden-sm hidden-md">
                @foreach ($categories as $category)
                <a href="/categoria/{{ $category->slug }}" class="list-group-item">{{ $category->name }} ({{ $category->articlesCount }}) <i class="fa fa-chevron-right"></i></a>
                @endforeach
            </div>
        </div>
    </div>
</div>

