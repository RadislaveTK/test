@extends('layouts.base')

@php
    $total = 0;
@endphp

@section('title', 'Счета')

@section('content')
<h2>Счета</h2>

<table class="table ">
    <thead>
        <tr>
            <th>Пространство</th>
            <th>Время</th>
            <th>Оплата в сек.</th>
            <th>Всего</th>
        </tr>
    </thead>
    <tbody>
        @foreach (Auth::user()->workspaces()->latest()->get() as $ws)
            <td>
                <h5>{{ $ws->title }}</h5>
            </td>
            @foreach ($ws->apiTokens()->get() as $api)
                @php $total += $api->total @endphp
                <tr>
                    <td>&emsp;{{ $api->name }}</td>
                    <td>{{ round($api->time, 4) }} s</td>
                    <td>{{ $api->price }} $</td>
                    <td>{{ round($api->total, 4) }} $</td>
                </tr>
            @endforeach
        @endforeach
    </tbody>
    @if ($total != 0)
    <tfoot>
        <tr>
            <td colspan="3"><h4>Всего</h4></td>
            <td colspan="1"><h4>{{ round($total, 4) }} $</h4></td>
            <td colspan="1"><a class="btn btn-success" href="{{ route('bills.pay') }}">Оплатить</a></td>
        </tr>
    </tfoot>
    @endif
</table>
@endsection