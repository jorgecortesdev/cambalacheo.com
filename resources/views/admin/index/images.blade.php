@extends('layouts/admin')

@section('page_title', 'Imágenes')

@section('content')

<div class="col-md-12">
    <table class="table table-stripped">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Imágen</th>
                <th class="text-center">Título</th>
                <th class="text-center">Tamaño</th>
                <th class="text-center">Mime</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($images as $image)
            <tr>
                <td class="text-right">{{ $image->id }}</td>
                <td class="text-center">
                    <img
                        class="img-responsive lazy"
                        data-original="{{ Cdn::image($image, 'thumbnail') }}"
                        src="{{ Cdn::asset('/image/article/default/thumbnail.gif') }}"
                    />
                </td>
                <td>{{ $image->article->title }}</td>
                <td class="text-center">{{ bytes_to_human($image->file_size) }}</td>
                <td class="text-center">{{ $image->file_mime }}</td>
                <td class="text-center">
                    <ul class="list-inline">
                        <li><a href="/articulo/{{ $image->article->slug }}"><i class="fa fa-eye"></i> Ver</a></li>
                    </ul>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row">
        <div class="col-md-12 text-center">{!! $images->render() !!}</div>
    </div>
</div>

@stop