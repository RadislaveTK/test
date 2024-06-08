@extends('layouts.base')
@php
    use App\Models\User;
    use App\Models\Workspace;
@endphp
@section('title', 'Админ Панель')

@section('content')

<h3>Здраствуйте {{ Auth::user()->name }}, вы находитесь в админ-панели!</h3>
<hr>
<h3>Таблица пользователей</h3>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Имя</th>
            <th>Email</th>
            <th>Role</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        @foreach (User::latest()->take(10)->get() as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td><a class="btn btn-success" href="{{ route('admin.editUser', ['user'=>$user->id]) }}">Редактировать</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
<hr>
<h3>Таблица пространств</h3>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Назване</th>
            <th>Описание</th>
            <th>User_ID</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        @foreach (Workspace::latest()->take(10)->get() as $ws)
            <tr>
                <td>{{ $ws->id }}</td>
                <td>{{ $ws->title }}</td>
                <td>{{ $ws->desc }}</td>
                <td>{{ $ws->user_id }}</td>
                <td><a class="btn btn-success" href="{{ route('admin.editWs', ['ws'=>$ws->id]) }}">Редактировать</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
<hr>
<h3>Настройки API</h3>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('admin.editConfigurate') }}" class="form" method="POST">
    @csrf
    <div class="mb-3 form-group">
        <label for="limit" class="form-label">Лимит использования</label>
        <input type="text" name="limit" class="form-control @error('limit') is-invalid @enderror" id="limit"
            value="{{ old('limit', config('app.TOKEN_LIMIT')) }}">
    </div>
    <div class="mb-3 form-group">
        <label for="price" class="form-label">Цена (1 с.)</label>
        <input type="text" name="price" class="form-control @error('price') is-invalid @enderror" id="price"
            value="{{ old('price', config('app.TOKEN_PRICE')) }}">
    </div>
    <button type="submit" class="btn btn-success">Сохранить</button>
</form>
@endsection