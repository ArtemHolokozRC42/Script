@extends('layouts.app')

@section('title', 'Адміністрування ігор')

@section('content')
    @php
        $sortLink = function (string $field) {
            $next = request('sort') === $field ? '-' . $field : $field;

            return route('games.admin', array_merge(request()->except('sort', 'page'), ['sort' => $next]));
        };
        $arrow = fn (string $field) => match (request('sort')) {
            $field       => ' ↑',
            '-' . $field => ' ↓',
            default      => '',
        };
    @endphp

    <h1>Адміністрування ігор</h1>

    <form method="GET" action="{{ route('games.admin') }}" class="search-form">
        <div class="field">
            <label for="title">Назва</label>
            <input id="title" name="title" type="text" value="{{ request('title') }}" placeholder="Частина назви">
        </div>
        <div class="field">
            <label for="developer">Розробник</label>
            <input id="developer" name="developer" type="text" value="{{ request('developer') }}">
        </div>
        <div class="field">
            <label for="platformName">Назва платформи</label>
            <input id="platformName" name="platformName" type="text" value="{{ request('platformName') }}" placeholder="Напр., Switch">
        </div>
        <div class="field">
            <label for="platform_id">Платформа</label>
            <select id="platform_id" name="platform_id">
                <option value="">Усі платформи</option>
                @foreach ($platforms as $id => $name)
                    <option value="{{ $id }}" @selected(request('platform_id') == $id)>{{ $name }}</option>
                @endforeach
            </select>
        </div>
        <input type="hidden" name="sort" value="{{ request('sort') }}">
        <button type="submit">Застосувати</button>
        <a href="{{ route('games.admin') }}">Скинути фільтри</a>
    </form>

    <p><a href="{{ route('games.create') }}">Додати гру</a></p>

    <table>
        <thead>
        <tr>
            <th>#</th>
            <th><a href="{{ $sortLink('title') }}">Назва{{ $arrow('title') }}</a></th>
            <th>Розробник</th>
            <th>Платформи</th>
            <th><a href="{{ $sortLink('platforms') }}">Платформ{{ $arrow('platforms') }}</a></th>
            <th><a href="{{ $sortLink('price') }}">Ціна{{ $arrow('price') }}</a></th>
            <th><a href="{{ $sortLink('year') }}">Рік{{ $arrow('year') }}</a></th>
            <th>Дії</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($games as $i => $game)
            <tr>
                <td>{{ $games->firstItem() + $i }}</td>
                <td><a href="{{ route('games.show', $game) }}">{{ $game->title }}</a></td>
                <td>{{ $game->developer }}</td>
                <td>
                    @forelse ($game->platforms as $platform)
                        <span class="tag">{{ $platform->name }}</span>
                    @empty
                        —
                    @endforelse
                </td>
                <td>{{ $game->platforms_count }}</td>
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
            <tr><td colspan="8">Ігор не знайдено.</td></tr>
        @endforelse
        </tbody>
    </table>

    {{ $games->links() }}
@endsection
