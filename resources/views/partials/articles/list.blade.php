<div class="row">
	<div class="col-md-12">
		<table class="table table-stripped table-responsive article-list article">
			@forelse ($articles as $article)
			{{--*/ $images = $article->images; /*--}}
			<tr>
				<td>
					<a href="/articulo/{{ $article->slug }}">
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
						<div class="col-md-7">
							<h4><a href="/articulo/{{ $article->slug }}">{{ str_limit($article->title, 45) }}</a></h4>
							<p class="description">{{ str_limit($article->description, 150) }}</p>
							<p class="small text-muted"><strong>Publicado:</strong> {{ $article->created_at->formatLocalized('%d/%B/%Y') }}</p>
{{-- 							<span class="hidden-xs pull-right">
								<a class="btn btn-sm btn-success" href="/articulo/{{ $article->slug }}">Ver detalle</a>
							</span> --}}
						</div>
						<div class="col-md-5 hidden-xs article-attributes">
							<div class="well">
								<ul class="list">
{{-- 									<li>
										<i class="fa fa-calendar btn btn-success"></i>&nbsp;
										{{ $article->created_at->formatLocalized('%d/%B/%Y') }}
									</li> --}}
									<li>
										<i class="fa fa-folder-open-o btn btn-success"></i>&nbsp;
										<a href="/categoria/{{ $article->category->slug }}">{{ str_limit($article->category->name, 27) }}</a>
									</li>
									<li>
										<i class="fa fa-asterisk btn btn-success"></i>&nbsp;
										<a href="/condicion/{{ article_condition($article->condition_id)['slug'] }}">{{ article_condition($article->condition_id)['name'] }}</a>
									</li>
									<li>
										<i class="fa fa-globe btn btn-success"></i>&nbsp;
										<a href="/ubicacion/{{ $article->user->state->slug }}/{{ $article->user->city->slug }}">
											{{ str_limit($article->user->city->name, 16) }}, {{ $article->user->state->short }}
										</a>
									</li>
								</ul>
							</div>
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
	</div>
</div>