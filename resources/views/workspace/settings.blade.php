@extends('layouts.base')

@section('title', $ws->title)
@section('content')
<h3>Редактирование {{ $ws->title }}</h3>
<form method="post" action="{{ route('settingsS', ['ws'=>$ws]) }}">
    @csrf
    <div class="mb-3 form-group">
        <label for="title" class="form-label">Название</label>
        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ old('title', $ws->title) }}">
    </div>
    <div class="mb-3 form-group">
        <label for="desc" class="form-label">Описание</label>
        <input type="text" name="desc" class="form-control @error('desc') is-invalid @enderror" id="desc" value="{{ old('desc', $ws->desc) }}">
    </div>
    <div class="mb-3 form-group">
        <label for="quota" class="form-label">Квота</label>
        <input type="text" name="quota" class="form-control @error('quota') is-invalid @enderror" id="quota" value="{{ old('quota', $ws->limit) }}">
    </div>
    <button type="submit" class="btn btn-success">Сохранить</button>
</form>
@endsection