<h4 class="h-top">Categorías</h4>

<ul class="list-unstyled">
	@foreach ($categories as $category)
	<li><a href="/category/{{ $category->id }}">{{ $category->name }}</a> ({{ $category->articlesCount }})</li>
	@endforeach
</ul>
