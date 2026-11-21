@extends('layouts.app')

@section('title', 'Користувачі')

@section('content')
    <h1>Користувачі системи</h1>

    <table>
        <thead>
        <tr><th>№</th><th>Ім'я</th><th>Зареєстровано</th></tr>
        </thead>
        <tbody>
        @forelse ($users as $i => $user)
            <tr>
                <td>{{ $users->firstItem() + $i }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->created_at->format('d.m.Y') }}</td>
            </tr>
        @empty
            <tr><td colspan="3">Користувачів немає.</td></tr>
        @endforelse
        </tbody>
    </table>

    {{ $users->links() }}
@endsection
