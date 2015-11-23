<div role="tabpanel" class="tab-pane fade @if ($tab_active) in active @endif" id="{{ $tab_id }}">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th class="text-center">Imágen</th>
                        <th class="text-center">Artículo</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($articles as $article)
                    <tr>
                        <td class="text-center">
                            <img
                                class="img-rounded lazy"
                                data-original="{{ Cdn::image($article->images->first(), 'thumbnail') }}"
                                src="{{ Cdn::asset('/image/article/default/thumbnail.gif') }}"
                            />
                        </td>
                        <td>{{ str_limit($article->title, 75) }}</td>
                        <td class="text-center">
                            <ul class="list-inline">
                                <li><a href="/articulo/{{ $article->slug }}"><i class="fa fa-eye"></i> Ver</a></li>
                                <li><a href="/panel/articles/edit/{{ $article->id }}"><i class="fa fa-edit"></i> Editar</a></li>
                                <li><a href="#" data-id="{{ $article->id }}" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i> Remover</a></li>
                            </ul>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">
                            <span>No hay artículos</span>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="row">
                <div class="col-md-12 text-center">{!! $articles->render() !!}</div>
            </div>
        </div>
    </div>
</div>