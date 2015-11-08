@extends('layouts.master')

@section('page_title', $article->title)

@section('footer')
<script src="{{ Cdn::url('/js/jquery.slides.min.js') }}"></script>
<script src="{{ Cdn::url('/js/show.js') }}"></script>
@endsection


@section('content')
{!! Breadcrumbs::render('category', $article->category) !!}

<h2>{{ $article->title }}</h2>

{{-- Article information --}}
<div class="row">
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-12">
                <div id="main-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach ($images as $index => $image)
                        <li data-target="#main-carousel" data-slide-to="{{ $index }}" @if ($index == 0) class="active" @endif></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner">
                        @foreach ($images as $index => $image)
                        <div class="item @if ($index == 0) active @endif">
                            <img
                                class="img-responsive lazy"
                                data-original="{{ Cdn::url('/image/article/' . $article->id . '/' . $image->id . '/original', 'image') }}"
                                src="{{ Cdn::url('/image/article/default/original.gif') }}"
                            />
                        </div>
                        @endforeach
                    </div>
                    <a class="left carousel-control" href="#main-carousel" role="button" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
                    <a class="right carousel-control" href="#main-carousel" role="button" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
                </div>
            </div>
        </div>

        <div class="row hidden-xs">
            <div class="col-md-12">
                <div id="main-carousel-thumbs">
                    <ul class="list-inline">
                        @foreach ($images as $index => $image)
                        <li data-target="#main-carousel" data-slide-to="{{ $index }}" @if ($index == 0) class="active" @endif>
                            <img
                                class="img-responsive lazy"
                                data-original="{{ Cdn::url('/image/article/' . $article->id . '/' . $image->id . '/thumbnail', 'image') }}"
                                src="{{ Cdn::url('/image/article/default/thumbnail.gif') }}"
                            />
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <table class="table table-condensed table-hover">
            <thead>
                <tr><th colspan="2">Detalle:</th>
            </tr></thead>
            <tbody style="font-size: 12px;">
                <tr>
                    <td>Fecha</td>
                    <td>{{ $article->created_at->format('d/m/Y') }}</td>
                </tr>
                <tr>
                    <td>Categoría</td>
                    <td>{{ $article->category->name }}</td>
                </tr>
                <tr>
                    <td>Condición</td>
                    <td>{{ $article_conditions[$article->condition_id] }}</td>
                </tr>
                <tr>
                    <td>Ubicación</td>
                    <td>{{ $article->user->city->name }}, {{ $article->user->state->short }}</td>
                </tr>
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
                <tr>
                    <td>Estado</td>
                    <td class="{{ $article_status_class }} article-status text-center">{{ $article_status[$article->status] }}</td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <div class="col-md-12">
                <div style="padding: 5px; font-weight: bold;">Propietario:</div>
                <div class="well">
                    <div class="row">
                        <div class="col-sm-4">
                            <img class="avatar" src="{{ Gravatar::src($article->user->email, 50) }}" alt="avatar">
                        </div>
                        <div class="col-sm-8">
                            <h4 style="margin-top: 0"><a href="#">{{ $article->user->name }}</a></h4>
                            <span title="Seller's rating: 4/5">
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star-empty"></span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Article description --}}
<div class="row">
	<div class="col-md-12">
		<h4>Descripción:</h4>
		<p class="text-muted">{{ $article->description }}</p>
	</div>
</div>

{{-- Article trade --}}
<div class="row">
	<div class="col-md-12">
		<h4>Cambalacheo por:</h4>
		<p class="text-muted">{{ $article->request }}</p>
	</div>
</div>

<br>

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

@endsection
