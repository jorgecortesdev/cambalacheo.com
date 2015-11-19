@extends('layouts/admin')

@section('page_title', 'Users')

@section('content')

<div class="col-md-12">
    <table class="table table-stripped">
        <thead>
            <tr>
                <th>#</th>
                <th>Imágen</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Provider</th>
                <th>Ubicación</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td><img class="avatar" src="{{ profile_picture($user, 50) }}" alt="avatar"></td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->provider }}</td>
                <td>{{ $user->city->name }}, {{ $user->state->short }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row">
        <div class="col-md-12 text-center">{!! $users->render() !!}</div>
    </div>
</div>

@stop