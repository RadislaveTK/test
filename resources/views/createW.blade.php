@extends('layouts.base')

@section('title', 'Создать пространство')
@section('content')
<h2>Создать пространство</h2>
<form class="form" action="{{ route('ws.store') }}" method="post">
    @csrf
    <div class="mb-3 form-group">
        <label for="title" class="form-label">Название</label>
        <input type="text" name="title" class="form-control" id="title">
    </div>
    <div class="mb-3 form-group">
        <label for="desc" class="form-label">Описание</label>
        <input type="text" name="desc" class="form-control" id="desc">
    </div>
    <button type="submit" class="btn btn-success">Создать</button>
</form>
@endsection