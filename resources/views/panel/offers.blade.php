@extends('layouts.master')

@section('page_title', 'Mis ofertas')

@section('footer')
<script type="text/javascript">
    $(document).ready(function() {
        var hash = document.location.hash;
        if (hash) {
            $('.nav-tabs a[href=' + hash + ']').tab('show');
        }
        // Change hash for page-reload
        $('.nav-tabs a').on('shown.bs.tab', function (e) {
            window.location.hash = e.target.hash;
        });
    });
</script>
@endsection

@section('content')

<h2>Ofertas</h2>
<p>Aquí puedes ver un listado de las ofertas que has enviado y las ofertas que has recibido.</p>

<hr>

<div>
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#received" role="tab" data-toggle="tab">Recibidas <span class="badge">{{ $offers_received->count() }}</span></a>
        </li>
        <li role="presentation">
            <a href="#sent" role="tab" data-toggle="tab">Enviadas <span class="badge">{{ $offers_sent->count() }}</span></a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        @include('partials.panel.offers_tab', [
            'offers'     => $offers_received,
            'tab_id'     => 'received',
            'tab_active' => true
        ])

        @include('partials.panel.offers_tab', [
            'offers'     => $offers_sent,
            'tab_id'     => 'sent',
            'tab_active' => false
        ])

    </div>
</div>

@endsection
