@extends('layouts.base')

@section('title', 'Админ Панель | Редактирование пользователя')

@section('content')
<h3>Редактирование пользователя {{ $user->name }}</h3>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('admin.storeUser') }}" class="form" method="POST">
    @csrf
    <div class="mb-3 form-group">
        <label for="id" class="form-label">ID</label>
        <input type="text" name="id" class="form-control @error('id') is-invalid @enderror" id="id"
            value="{{ old('id', $user->id) }}" readonly>
    </div>
    <div class="mb-3 form-group">
        <label for="name" class="form-label">Имя</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
            value="{{ old('name', $user->name) }}">
    </div>
    <div class="mb-3 form-group">
        <label for="email" class="form-label">Email</label>
        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email"
            value="{{ old('email', $user->email) }}">
    </div>
    <div class="mb-3 form-group">
        <select name="role" class="form-select" >
            <option value="user" selected>Пользователь</option>
            <option value="admin">Админ</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Сохранить</button>
</form>
@endsection