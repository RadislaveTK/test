@extends('layouts.base')

@section('title', $ws->title)
@section('content')
<p class="d-flex justify-content-between">
    <a href="{{ route('ws.createApi', ['ws'=>$ws]) }}" class="btn btn-success">Создать API</a>
    <a class="btn btn-warning" href="{{ route('ws.delete', ['ws'=>$ws]) }}">Удалить пространство</a>
</p>
<h2>Токены</h2>
<table class="table">
    <thead>
        <tr>
            <th>Название</th>
            <th>Время отзыва</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($ws->apiTokens()->get() as $api)
        <tr>
            <td>{{ $api->name }}</td>
            <td>{{ $api->revoked_at }}</td>
            @if ($api->revoked_at === null)
                <td><a href="{{ route('ws.removeApi', ['ws'=>$ws->id, 'ap'=>$api->id]) }}" class="btn btn-danger">Отозвать</a></td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>

@endsection