@extends('layouts.master')

@section('page_title', $article->title)

@section('custom_css')
<link href="/css/bootstrap-lightbox.min.css" rel="stylesheet">
@endsection

@section('content')

<h3 class="h-top">{{ $article->title }}</h3>

{{-- Article information --}}
<div class="row">
	<div class="col-md-4">
		<a href="#" data-toggle="modal" data-target="#lightbox">
            <img src="/image/article/{{ $article->id }}/profile/1" alt="" class="img-rounded">				
        </a>
	</div>
	<div class="col-md-8">
		<div class="panel panel-default">
			<div class="panel-body">
				<dl class="dl-horizontal">
					<dt>Publicado por</dt>
					<dd>{{ $article->user->name }}</dd>

					<dt>Fecha</dt>
					<dd>{{ $article->created_at->format('d/m/Y') }}</dd>

					<dt>Categoría</dt>
					<dd>{{ $article->category->name }}</dd>

					<dt>Condición</dt>
					<dd>{{ $article_conditions[$article->condition_id] }}</dd>

                    <dt>Ubicación</dt>
                    <dd>{{ $article->user->city->name }}, {{ $article->user->state->short }}</dd>
					{{--*/ 
						$article_status_class = 'bg-info'; 
						switch($article->status) {
							case ARTICLE_STATUS_EXCHANGE:
								$article_status_class = 'bg-success';
								break;
							case ARTICLE_STATUS_CLOSE_ADMIN:
								$article_status_class = 'bg-danger';
								break;
							case ARTICLE_STATUS_CLOSE_USER:
								$article_status_class = 'bg-warning';
								break;
						}
					/*--}}
					<dt>Cambalacheo</dt>					
					<dd class="{{ $article_status_class }} article-status text-center">{{ $article_status[$article->status] }}</dd>
				</dl>				
			</div>
		</div>
				
	</div>
</div>
{{-- Article images --}}
<div id="lightbox" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <button type="button" class="close hidden" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
        <div class="modal-content">
            <div class="modal-body">
                <img src="" alt="" />
            </div>
        </div>
    </div>
</div>

@if (count($images) > 0)
<br>
<div class="row">
	<div class="col-md-12">
		@foreach ($images as $index)
        <a href="#" data-toggle="modal" data-target="#lightbox">
            <img src="/image/article/{{ $article->id }}/thumbnail/{{ $index }}" alt="" class="img-rounded">
        </a>
		@endforeach
	</div>
</div>
@endif

{{-- Article description --}}
<div class="row">
	<div class="col-md-12">
		<h5><strong>Descripción:</strong></h5>
		<p class="text-muted">{{ $article->description }}</p>
	</div>
</div>

{{-- Article trade --}}
<div class="row">
	<div class="col-md-12">
		<h5><strong>Cambio por:</strong></h5>
		<p class="text-muted">{{ $article->request }}</p>		
	</div>
</div>

{{-- Article questions --}}
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading clearfix">
				<h4 class="panel-title pull-left">Preguntas</h4>
				@if ($logged_user_id != $article->user_id)
				<a href="/trades/question/{{ $article->id }}" class="btn btn-sm btn-primary pull-right">Hacer pregunta</a>
				@endif
			</div>
			<div class="panel-body">
				@if (count($article->questions) > 0)
                <ul class="comments-list">
					@foreach ($article->questions as $question)
                    <li class="comment">
                        <a class="pull-left" href="#">
                            <img class="avatar" src="{{ Gravatar::src($question->user->email, 50) }}" alt="avatar">
                        </a>
                        <div class="comment-body">
                            <div class="comment-heading">
                                <h4 class="user">{{ $question->user->name }}</h4>
                                <h5 class="time">{{ $question->created_at->diffForHumans() }}</h5>
                            </div>
                            <p>{{ $question->description }}</p>
                        </div>
                        @if (count($question->replays) > 0)
                        <ul class="comments-list">
                        	@foreach ($question->replays as $replay)
                            <li class="comment">
                                <a class="pull-left" href="#">
                                    <img class="avatar" src="{{ Gravatar::src($replay->user->email, 44) }}" alt="avatar">
                                </a>
                                <div class="comment-body">
                                    <div class="comment-heading">
                                        <h4 class="user">{{ $replay->user->name }}</h4>
                                        <h5 class="time">{{ $replay->created_at->diffForHumans() }}</h5>
                                    </div>
                                    <p>{{ $replay->description }}</p>
                                </div>
                            </li> 
                            @endforeach
                        </ul>
                        @endif
                    </li>
                    <li class="comment-replay">
                    	@if ($logged_user_id == $article->user->id || $logged_user_id == $question->user_id)
                        <div class="row">
                            <div class="col-md-10 vcenter">
                                {!! Form::open(['url' => 'trades/question/replay', 'class' => 'form-replay pull-left', 'id' => 'form-' . $article->id . '-' . $question->id, 'style' => 'display: none']) !!}
                                    {!! Form::hidden('article_id', $article->id) !!}
                                    {!! Form::hidden('parent_id', $question->id) !!}
                                    {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Escribe la respuesta...']) !!}
                                {!! Form::close() !!}
                            </div><!--
                            --><div class="col-md-2 vcenter">
                                <a class="pull-right replay" data-form="form-{{ $article->id }}-{{ $question->id }}" href="#"><i class="fa fa-reply"></i> Responder</a>
                                <a class="send" style="display: none" data-form="form-{{ $article->id }}-{{ $question->id }}" href="#"><i class="fa fa-paper-plane"></i> Enviar</a>
                                
                            </div>
                        </div>
            			@endif
                		<div class="row">
                			<div class="col-md-12"><hr></div>
            			</div>
            		</li>
                    @endforeach
                </ul>
                @else
				<div class="row">
					<div class="col-md-12">
						<span>No hay preguntas</span>
					</div>
				</div>
				@endif
						
			</div>
		</div>

	</div>
</div>

{{-- Article offers --}}
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading clearfix">
				<h4 class="panel-title pull-left">Ofertas</h4>
				@if ($logged_user_id != $article->user_id)
				<a href="/trades/offer/{{ $article->id }}" class="btn btn-sm btn-primary pull-right">Hacer oferta</a>
				@endif
			</div>
			<div class="panel-body">
				@if (count($article->offers) > 0)
                <ul class="comments-list">
					@foreach ($article->offers as $offer)
					{{--*/ 
						$offer_status_class = ''; 
						$offer_message = '';
						switch($offer->status) {
							case OFFER_STATUS_REJECTED:
								$offer_status_class = 'bg-danger';
								$offer_message = 'Rechazado';
								break;
							case OFFER_STATUS_ACCEPTED:
								$offer_status_class = 'bg-success';
								$offer_message = 'Aceptado';
								break;
						}
					/*--}}
                    <li class="comment {{ $offer_status_class }}">
                        <a class="pull-left" href="#">
                            <img class="avatar" src="{{ Gravatar::src($offer->user->email, 50) }}" alt="avatar">
                        </a>
                        <div class="comment-body">
                            <div class="comment-heading">
                                <h4 class="user">{{ $offer->user->name }}</h4>
                                <h5 class="time">{{ $offer->created_at->diffForHumans() }}</h5>
                            </div>
                            <p>{{ $offer->description }}</p>
                        </div>
                        @if (count($offer->replays) > 0)
                        <ul class="comments-list">
                        	@foreach ($offer->replays as $replay)
                            <li class="comment">
                                <a class="pull-left" href="#">
                                    <img class="avatar" src="{{ Gravatar::src($replay->user->email, 44) }}" alt="avatar">
                                </a>
                                <div class="comment-body">
                                    <div class="comment-heading">
                                        <h4 class="user">{{ $replay->user->name }}</h4>
                                        <h5 class="time">{{ $replay->created_at->diffForHumans() }}</h5>
                                    </div>
                                    <p>{{ $replay->description }}</p>
                                </div>
                            </li> 
                            @endforeach
                        </ul>
                        @endif
                    </li>                    
                    <li class="comment-replay">
                    	@if ($logged_user_id == $article->user->id || $logged_user_id == $offer->user_id)
                    	<div class="row">
                            <div class="col-md-10 vcenter">
                                {!! Form::open(['url' => 'trades/offer/replay', 'class' => 'form-replay pull-left', 'id' => 'form-' . $article->id . '-' . $offer->id, 'style' => 'display: none']) !!}
                                    {!! Form::hidden('article_id', $article->id) !!}
                                    {!! Form::hidden('parent_id', $offer->id) !!}
                                    {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Escribe tu oferta...']) !!}
                                {!! Form::close() !!}
                            </div><!--
                            --><div class="col-md-2 vcenter">
                                <a class="pull-right replay" data-form="form-{{ $article->id }}-{{ $offer->id }}" href="#"><i class="fa fa-reply"></i> Responder</a>
                                <a class="send" style="display: none" data-form="form-{{ $article->id }}-{{ $offer->id }}" href="#"><i class="fa fa-paper-plane"></i> Enviar</a>
                            </div>
                        </div>
                        @endif
                    </li>
                    <li class="comment-controls">
                        <div class="row">
                    		<div class="col-md-12 text-center">
                    			<span class="">
                    				<ul class="list-inline">
                    					@if ($offer->status == OFFER_STATUS_OPEN && $logged_user_id == $article->user->id)
                                            <li><a class="btn btn-default btn-success" href="/trades/offer/accept/{{ $offer->id }}"><i class="fa fa-check"></i> Aceptar oferta</a></li>
                                            <li><a class="btn btn-default btn-danger" href="/trades/offer/reject/{{ $offer->id }}"><i class="fa fa-times"></i> Rechazar oferta</a></li>
                    					@else
                    					   <li><strong>{{ $offer_message }}</strong></li>
                    					@endif
                    				</ul>
                				</span>
                			</div>
                		</div>
                    </li>
                    @endforeach
                </ul>
                @else
				<div class="row">
					<div class="col-md-12">
						<span>No hay ofertas</span>
					</div>
				</div>
				@endif

			</div>
		</div>

	</div>
</div>

{{-- More articles in category --}}
@if (count($more_articles) > 0)
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">Más en esta categoría</h4>
			</div>
			<div class="panel-body">
				<div id="myCarousel" class="carousel slide">
					<!-- Carousel items -->
					{{--*/ $isFirst = true; /*--}}
					<div class="carousel-inner">
						@foreach($more_articles as $chunk)
						<div class="item{{{ $isFirst ? ' active' : '' }}}">
							<div class="row">
								@foreach($chunk as $article)
								<div class="col-sm-3">
									<a href="/trades/{{ $article->id }}">
										<img src="/image/article/{{ $article->id }}/carousel" class="img-rounded">
										 <div class="carousel-caption">
		          							<span class="small">{{ $article->title }}</span>
		      							</div>
									</a>
								</div>
								@endforeach
							</div><!--/row-->
						</div>
						{{--*/ $isFirst = false; /*--}}
						@endforeach
					</div>
					<!--/carousel-inner-->
					<a class="left carousel-control" href="#myCarousel" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
					<a class="right carousel-control" href="#myCarousel" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
				</div>				
			</div>
		</div>

	</div>
</div>
@endif

@endsection

@section('scripts')
    <script src="/js/bootstrap-lightbox.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function() {
			$('#myCarousel').carousel({
				interval: false
			});

            var $lightbox = $('#lightbox');
    
            $('[data-target="#lightbox"]').on('click', function(event) {
                var $img = $(this).find('img'), 
                    src = $img.attr('src'),
                    alt = $img.attr('alt'),
                    css = {
                        'maxWidth': $(window).width() - 100,
                        'maxHeight': $(window).height() - 100
                    };

                src = src.replace('profile', 'original').replace('thumbnail', 'original');

                $lightbox.find('.close').addClass('hidden');
                $lightbox.find('img').attr('src', src);
                $lightbox.find('img').attr('alt', alt);
                $lightbox.find('img').css(css);
            });
    
            $lightbox.on('shown.bs.modal', function (e) {
                var $img = $lightbox.find('img');
                    
                $lightbox.find('.modal-dialog').css({'width': $img.width()});
                $lightbox.find('.close').removeClass('hidden');
            });

            $('.replay').click(function() {
                $('.form-replay').hide();
                $('.send').hide();
                $('.replay').show();

                var frm = $(this).data('form'); 
                $("#" + frm).show();
                $("#" + frm).find('input:text:visible:first').focus();

                var send = $(this).next('.send');
                send.show();

                $(this).hide();
                return false;
            })

            $('.send').click(function() {
                var frm = $(this).data('form'); 
                $("#" + frm).submit();
                return false;
            });
		});
	</script>
@endsection
