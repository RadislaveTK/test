@extends('layouts.base')

@section('title', $ws->title)
@section('content')
<p class="d-flex justify-content-between">
    <a href="{{ route('ws.createApi', ['ws' => $ws]) }}" class="btn btn-success">Создать API</a>
    <a class="btn btn-primary" href="{{ route('settings', ['ws' => $ws]) }}">Редактировать пространство</a>
    <a class="btn btn-warning" href="{{ route('ws.delete', ['ws' => $ws]) }}">Удалить пространство</a>
</p>
<h2>Токены</h2>
<table class="table">
    <thead>
        <tr>
            <th>Название</th>
            <th>Время создания</th>
            <th>Время отзыва</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($ws->apiTokens()->latest()->get() as $api)
            <tr>
                <td>{{ $api->name }}</td>
                <td>{{ $api->created_at }}</td>
                <td>{{ $api->revoked_at }}</td>
                @if ($api->revoked_at === null || $api->blocking == true)
                    <td><a href="{{ route('ws.removeApi', ['ws' => $ws->id, 'ap' => $api->id]) }}"
                            class="btn btn-danger">Отозвать</a></td>
                            <td><a href="{{ route('api.view', ['ap' => $api->token]) }}"
                            class="btn btn-success">Перейти</a></td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>

@endsection