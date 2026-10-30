@extends('layouts.app')

@section('title', 'Детальна статистика')

@section('content')
    <h1>Детальна статистика</h1>

    <p>
        Фільтр: <strong>{{ $type }}</strong> = <strong>{{ $item }}</strong>
    </p>

    <table>
        <thead>
        <tr>
            <th>Сторінка</th>
            <th>IP</th>
            <th>Статус</th>
            <th>Дата і час</th>
            <th>Метод</th>
            <th>Маршрут</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($rows as $row)
            <tr>
                <td>{{ $row->page }}</td>
                <td>{{ $row->ip }}</td>
                <td>{{ $row->status }}</td>
                <td>{{ $row->visited_at->format('d.m.Y H:i:s') }}</td>
                <td>{{ $row->method }}</td>
                <td>{{ $row->route_name }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $rows->links() }}
@endsection
