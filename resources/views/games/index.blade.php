@extends('layouts.app')

@section('title', 'Каталог ігор')

@section('content')
    <h1>Каталог ігор</h1>

    <form method="GET" action="{{ route('games.index') }}" class="filter">
        <label for="genre">Жанр</label>
        <select id="genre" name="genre">
            <option value="">Усі жанри</option>
            @foreach ($genres as $g)
                <option value="{{ $g }}" @selected($genre === $g)>{{ $g }}</option>
            @endforeach
        </select>
        <button type="submit">Фільтрувати</button>
        <a href="{{ route('games.index') }}">Скинути</a>
    </form>

    <p><a href="{{ route('games.create') }}">Додати гру</a></p>

    <table>
        <thead>
        <tr>
            <th>#</th><th>Назва</th><th>Жанр</th><th>Розробник</th>
            <th>Ціна</th><th>Рік</th><th>Дії</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($games as $i => $game)
            <tr>
                <td>{{ $games->firstItem() + $i }}</td>
                <td><a href="{{ route('games.show', $game) }}">{{ $game->title }}</a></td>
                <td>{{ $game->genre }}</td>
                <td>{{ $game->developer }}</td>
                <td>${{ number_format($game->price, 2, ',', ' ') }}</td>
                <td>{{ $game->release_year }}</td>
                <td>
                    <a href="{{ route('games.edit', $game) }}">Редагувати</a>
                    <form method="POST" action="{{ route('games.destroy', $game) }}"
                          style="display:inline" onsubmit="return confirm('Видалити гру?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Видалити</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="7">Ігор не знайдено.</td></tr>
        @endforelse
        </tbody>
    </table>

    {{ $games->links() }}
@endsection
