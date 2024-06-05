@extends('layouts.base')

@section('title', 'Создать пространство')

@section('content')
<h2>Создать пространство</h2>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form class="form" action="{{ route('ws.store') }}" method="post">
    @csrf
    <div class="mb-3 form-group">
        <label for="title" class="form-label">Название</label>
        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ old('title') }}">
    </div>
    <div class="mb-3 form-group">
        <label for="desc" class="form-label">Описание</label>
        <input type="text" name="desc" class="form-control @error('desc') is-invalid @enderror" id="desc" value="{{ old('desc') }}">
    </div>
    <button type="submit" class="btn btn-success">Создать</button>
</form>
@endsection