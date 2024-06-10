@extends('layouts.base')

@section('title', 'Админ Панель | Редактирование пространства')

@section('content')
<h3>Редактирование пространства {{ $ws->title }}</h3>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('admin.storeWs') }}" class="form" method="POST">
    @csrf
    <div class="mb-3 form-group">
        <label for="id" class="form-label">ID</label>
        <input type="text" name="id" class="form-control @error('id') is-invalid @enderror" id="id"
            value="{{ old('id', $ws->id) }}" readonly>
    </div>
    <div class="mb-3 form-group">
        <label for="title" class="form-label">Название</label>
        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title"
            value="{{ old('title', $ws->title) }}">
    </div>
    <div class="mb-3 form-group">
        <label for="desc" class="form-label">Описание</label>
        <input type="text" name="desc" class="form-control @error('desc') is-invalid @enderror" id="desc"
            value="{{ old('desc', $ws->desc) }}">
    </div>
    <button type="submit" class="btn btn-success">Сохранить</button>
</form>
@endsection