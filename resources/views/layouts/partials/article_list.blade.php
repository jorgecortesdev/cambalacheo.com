<div class="row">
	<div class="col-md-12">
		<table class="table table-stripped article">
			@forelse ($articles as $article)
			<tr>
				<td>
					<img class="img-rounded" src="{{ Cdn::url('/image/article/' . $article->id . '/list', 'image') }}" alt="Placeholder">
				</td>
				<td>
					<h5><a href="/trades/{{ $article->id }}">{{ $article->title }}</a></h5>
					<p class="small description">{{ $article->description }}</p>

					<ul class="small list-inline pull-left">
						<li><i class="glyphicon glyphicon-calendar"></i>&nbsp;&nbsp;{{ $article->created_at->format('d/m/Y') }}</li>
						<li><i class="glyphicon glyphicon-folder-open"></i>&nbsp;&nbsp;<a href="/category/{{ $article->category->id }}">{{ $article->category->name }}</a></li>
						<li><i class="glyphicon glyphicon-asterisk"></i>&nbsp;&nbsp;<a href="/condition/{{ $article->condition_id }}">{{ $conditions[$article->condition_id] }}</a></li>
						<li>
							<i class="fa fa-globe"></i>&nbsp;&nbsp;<a href="/location/{{ $article->user->state->id }}/{{ $article->user->city->id }}">
								{{ $article->user->city->name }}, {{ $article->user->state->short }}
							</a>
						</li>
					</ul>
					<span class="small pull-right">
						<a class="btn btn-default" href="/trades/{{ $article->id }}">Ver detalle</a>
					</span>
				</td>
			</tr>
			@empty
			<tr>
				<td>No hay artiículos ha mostrar</td>
			</tr>
			@endforelse
		</table>

		@if ($articles->count() > 10)
		<div class="row">
			<div class="col-md-12 text-center">{!! $articles->render() !!}</div>
		</div>
		@endif
	</div>
</div>