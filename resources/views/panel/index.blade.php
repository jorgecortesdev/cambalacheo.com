@extends('layouts.master')

@section('page_title', 'Mis artículos')

@section('footer')
<script type="text/javascript" src="{{ Cdn::asset('/js/article.js') }}"></script>
@endsection

@section('content')

<h2>Panel</h2>
<p>Aquí puedes ver un listado de los artículos que has publicado, permutado o se encuentren en algún otro estado diferente.</p>

<hr>

<div>
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#active" role="tab" data-toggle="tab">Activos <span class="badge">{{ $articles_active->total() }}</span></a>
        </li>
        <li role="presentation">
            <a href="#permuted" role="tab" data-toggle="tab">Permutados <span class="badge">{{ $articles_permuted->total() }} </span></a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        @include('partials.panel.articles_tab', [
            'articles'   => $articles_active,
            'tab_id'     => 'active',
            'tab_active' => true
        ])

        @include('partials.panel.articles_tab', [
            'articles'   => $articles_permuted,
            'tab_id'     => 'permuted',
            'tab_active' => false
        ])
    </div>
</div>

<!-- Modal -->
@include('partials.modal.remove_article')

@endsection
