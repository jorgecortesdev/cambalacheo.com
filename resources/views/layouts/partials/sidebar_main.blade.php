<h4 class="hidden-xs">Búsqueda</h4>
<div class="hidden-xs well well-sm">
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

<div class="hidden-xs hidden-sm hidden-md">
    <h4>Categorías</h4>
    <div class="categories list-group hidden-xs hidden-sm hidden-md">
        @foreach ($categories as $category)
        <a href="/categoria/{{ $category->slug }}" class="list-group-item">{{ $category->name }} ({{ $category->articlesCount }}) <i class="fa fa-chevron-right"></i></a>
        @endforeach
    </div>
</div>
