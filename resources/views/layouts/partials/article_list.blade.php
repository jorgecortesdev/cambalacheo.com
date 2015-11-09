<div class="row">
	<div class="col-md-12">
		<table class="table table-stripped article-list article">
			@forelse ($articles as $article)
			{{--*/ $images = $article->images; /*--}}
			<tr>
				<td>
					<a href="/trades/{{ $article->id }}">
						<img
							class="img-rounded lazy"
							data-original="{{ Cdn::image($images->first(), 'list') }}"
							src="{{ Cdn::asset('/image/article/default/list.gif') }}"
						/>
						<span class="photo-counter">{{ $images->count() }} Foto(s)</span>
					</a>
				</td>
				<td>
					<div class="row">
						<div class="col-md-8">
							<h4><a href="/trades/{{ $article->id }}">{{ $article->title }}</a></h4>
							<p class="description">{{ str_limit($article->description, 150) }}</p>
							<span class="pull-right">
								<a class="btn btn-sm btn-default" href="/trades/{{ $article->id }}">Ver detalle</a>
							</span>
						</div>
						<div class="col-md-4">
							<ul class="list">
								<li><i class="glyphicon glyphicon-calendar"></i>&nbsp;&nbsp;{{ $article->created_at->format('d/m/Y') }}</li>
								<li><i class="glyphicon glyphicon-folder-open"></i>&nbsp;&nbsp;<a href="/category/{{ $article->category->id }}">{{ str_limit($article->category->name, 27) }}</a></li>
								<li><i class="glyphicon glyphicon-asterisk"></i>&nbsp;&nbsp;<a href="/condition/{{ $article->condition_id }}">{{ $conditions[$article->condition_id] }}</a></li>
								<li>
									<i class="fa fa-globe"></i>&nbsp;&nbsp;<a href="/location/{{ $article->user->state->id }}/{{ $article->user->city->id }}">
										{{ str_limit($article->user->city->name, 17) }}, {{ $article->user->state->short }}
									</a>
								</li>
							</ul>
						</div>
					</div>

				</td>
			</tr>
			@empty
			<tr>
				<td>No hay artiículos ha mostrar</td>
			</tr>
			@endforelse
		</table>

		<div class="row">
			<div class="col-md-12 text-center">{!! $articles->render() !!}</div>
		</div>

	</div>
</div>