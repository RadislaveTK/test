@extends('layouts.base')

@section('title', 'Пространства')
@section('content')
<p class="text-right"><a href="{{ route('ws.create') }}">Создать</a></p>
@if (count($ws) > 0)
<table class="table">
    <thead>
        <tr>
            <th>Название</th>
            <th>Описание</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($ws as $w)
        <tr>
            <td>{{ $w->title }}</td>
            <td>{{ $w->desc }}</td>
            <td><a class="btn" href="{{ route('detail', ['ws'=>$w]) }}">Перейти</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
@endsection