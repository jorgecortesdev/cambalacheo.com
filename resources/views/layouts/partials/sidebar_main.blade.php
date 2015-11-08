<h4>Búsqueda</h4>
<div class="well well-sm">
    {!! Form::open(['url' => '/search', 'method' => 'get']) !!}
    <div class="input-group">
        {!! Form::text('q', null, ['class' => 'form-control', 'placeholder' => 'Busca por...']) !!}
        <span class="input-group-btn">
            {!! Form::button('<i class="fa fa-search"></i>', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
        </span>
    </div>
    {!! Form::close() !!}
</div>

<h4>Categorías</h4>
<div class="categories list-group">
    @foreach ($categories as $category)
    <a href="/category/{{ $category->id }}" class="list-group-item">{{ $category->name }} ({{ $category->articlesCount }}) <i class="fa fa-chevron-right"></i></a>
    @endforeach
</div>
