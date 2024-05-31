@extends('layouts.base')

@section('title', $ws->title)
@section('content')
    <p class="text-right"><a class="btn" href="{{ route('ws.delete', ['ws'=>$ws]) }}">Удалить пространство</a></p>

@endsection