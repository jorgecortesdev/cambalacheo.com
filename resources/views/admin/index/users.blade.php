@extends('layouts/admin')

@section('page_title', 'Users')

@section('content')

<div class="col-md-12">
    <table class="table table-stripped table-hover">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Imágen</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">Correo</th>
                <th class="text-center">Provider</th>
                <th class="text-center">Ubicación</th>
                <th class="text-center">Ip</th>
                <th class="text-center">Ultimo acceso</th>
                <th class="text-center">Registro</th>
                <th class="text-center">Publicaciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td class="text-center">{{ $user->id }}</td>
                <td class="text-center"><img class="avatar" src="{{ profile_picture($user, 50) }}" alt="avatar"></td>
                <td class="text-center">{{ $user->name }}</td>
                <td class="text-center">{{ $user->email }}</td>
                <td class="text-center">{{ $user->provider }}</td>
                <td class="text-center">{{ $user->city->name }}, {{ $user->state->short }}</td>
                <td class="text-center">{{ $user->ip }}</td>
                <td class="text-center">{{ $user->lastlogin_at }}</td>
                <td class="text-center">{{ $user->created_at }}</td>
                <td class="text-center">{{ $user->articles->count() }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row">
        <div class="col-md-12 text-center">{!! $users->render() !!}</div>
    </div>
</div>

@stop