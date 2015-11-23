<div role="tabpanel" class="tab-pane @if ($tab_active) in active @endif" id="{{ $tab_id }}">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th class="text-center">Imágen</th>
                        <th class="text-center">Artículo</th>
                        <th class="text-center">Pregunta</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($questions as $question)
                    <tr>
                        <td class="text-center">
                            <img
                                class="img-rounded lazy"
                                data-original="{{ Cdn::image($question->article->images->first(), 'thumbnail') }}"
                                src="{{ Cdn::asset('/image/article/default/thumbnail.gif') }}"
                            />
                        </td>
                        <td>{{ $question->article->title }}</td>
                        <td>{{ $question->description }}</td>
                        <td class="text-center">
                            <ul class="list-inline">
                                <li><a href="/articulo/{{ $question->article->slug }}"><i class="fa fa-eye"></i> Ver</a></li>
                            </ul>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">
                            <span>No hay preguntas</span>
                        </td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
</div>