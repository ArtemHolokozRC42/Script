@extends('layouts.app')

@section('title', 'Платформи')

@section('content')
    <h1>Платформи</h1>

    <table>
        <thead>
        <tr><th>#</th><th>Платформа</th><th>Ігор</th></tr>
        </thead>
        <tbody>
        @foreach ($platforms as $i => $platform)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $platform->name }}</td>
                <td>{{ $platform->games_count }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
