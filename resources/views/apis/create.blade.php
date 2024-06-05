@extends('layouts.base')
@section('title', 'Создать токен')

@section('content')
<h2>Создать токен</h2>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form class="form" action="{{ route('ws.storeApi', ['ws'=>$ws]) }}" method="post">
    @csrf
    <div class="mb-3 form-group">
        <label for="name" class="form-label">Название</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}">
    </div>
    <div class="mb-3 form-group">
        <label for="token" class="form-label">Токен</label>
        <input type="text" readonly name="token" class="form-control-plaintext" id="token" value="{{ bin2hex(random_bytes(20)) }}">
    </div>
    <button type="submit" class="btn btn-success">Создать</button>
</form>
@endsection