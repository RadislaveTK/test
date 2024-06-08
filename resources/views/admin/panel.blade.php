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
        <td><a class="btn btn-success" href="#">Редактировать</a></td>
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
        <td><a class="btn btn-success" href="#">Редактировать</a></td>
    </tr>
    @endforeach
</tbody>
</table>
<hr>
Настройки API
<form action="" class="form">
    
</form>
@endsection