@extends('layouts.app')

@section('title', $game->title)

@section('content')
    <h1>{{ $game->title }}</h1>

    <p><strong>Жанр:</strong> {{ $game->genre }}</p>
    <p><strong>Розробник:</strong> {{ $game->developer }}</p>
    <p><strong>Ціна:</strong> ${{ number_format($game->price, 2, ',', ' ') }}</p>
    <p><strong>Рік випуску:</strong> {{ $game->release_year }}</p>
    <p><strong>Опис:</strong> {{ $game->description ?? '—' }}</p>

    <p>
        <a href="{{ route('games.edit', $game) }}">Редагувати</a> |
        <a href="{{ route('games.index') }}">Повернутися до списку</a>
    </p>

    <form method="POST" action="{{ route('games.destroy', $game) }}"
          onsubmit="return confirm('Видалити гру?')">
        @csrf
        @method('DELETE')
        <button type="submit">Видалити</button>
    </form>
@endsection
