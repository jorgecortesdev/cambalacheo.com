@extends('layouts/admin')

@section('page_title', 'Facebook')

@section('content')

<div class="col-md-12">
    <a href="{{ $loginUrl }}" class="btn btn-primary pull-right">Regenerar Token</a>
    <br><br><br>
    <table class="table table-stripped" style="table-layout: fixed; word-wrap: break-word;">
        <colgroup>
            <col class="col-md-1">
            <col class="col-md-7">
            <col class="col-md-2">
            <col class="col-md-2">
        </colgroup>
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Token</th>
                <th class="text-center">Created</th>
                <th class="text-center">Updated</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($facebookApps as $app)
            <tr>
                <td class="text-center">{{ $app->id }}</td>
                <td class="text-left">{{ $app->token }}</td>
                <td class="text-center">{{ $app->created_at }}</td>
                <td class="text-center">{{ $app->updated_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@stop