@extends('layouts.app')

@section('title', 'Особистий кабінет')

@section('content')
    <h1>Особистий кабінет</h1>

    <p><strong>Ім'я:</strong> {{ $user->name }}</p>
    <p><strong>Електронна пошта:</strong> {{ $user->email }}</p>
    <p><strong>Зареєстровано:</strong> {{ $user->created_at->format('d.m.Y') }}</p>
    <p><a href="{{ route('profile.edit') }}">Редагувати профіль</a></p>

    <h2>Мої ігри ({{ $gamesTotal }})</h2>
    <p><a href="{{ route('games.create') }}">Додати гру</a></p>

    <table>
        <thead>
        <tr><th>#</th><th>Назва</th><th>Жанр</th><th>Платформ</th><th>Створено</th><th>Дії</th></tr>
        </thead>
        <tbody>
        @forelse ($games as $i => $game)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td><a href="{{ route('games.show', $game) }}">{{ $game->title }}</a></td>
                <td>{{ $game->genre }}</td>
                <td>{{ $game->platforms_count }}</td>
                <td>{{ $game->created_at->format('d.m.Y H:i') }}</td>
                <td><a href="{{ route('games.edit', $game) }}">Редагувати</a></td>
            </tr>
        @empty
            <tr><td colspan="6">Ви ще не додали жодної гри.</td></tr>
        @endforelse
        </tbody>
    </table>
@endsection
