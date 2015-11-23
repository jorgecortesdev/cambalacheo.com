<div role="tabpanel" class="tab-pane fade @if ($tab_active) in active @endif" id="{{ $tab_id }}">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th class="text-center">Imágen</th>
                        <th class="text-center">Artículo</th>
                        <th class="text-center">Oferta</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($offers as $offer)
                    <tr>
                        <td class="text-center">
                            <img
                                class="img-rounded lazy"
                                data-original="{{ Cdn::image($offer->article->images->first(), 'thumbnail') }}"
                                src="{{ Cdn::asset('/image/article/default/thumbnail.gif') }}"
                            />
                        </td>
                        <td>{{ $offer->article->title }}</td>
                        <td>{{ $offer->description }}</td>
                        <td class="text-center">
                            <ul class="list-inline">
                                <li><a href="/articulo/{{ $offer->article->slug }}"><i class="fa fa-eye"></i> Ver</a></li>
                            </ul>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">
                            <span>No hay ofertas</span>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>