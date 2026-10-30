@extends('layouts.app')

@section('title', 'Популярні ігри')

@section('content')
    <h1>Найпопулярніші ігри</h1>
    <p>Кількість переглядів сторінки гри за даними трекера.</p>
    <p><a href="{{ route('stats.pages') }}">← До загальної статистики</a></p>

    <table>
        <thead>
        <tr>
            <th>#</th>
            <th>Гра</th>
            <th>Переглядів</th>
            <th>Останній перегляд</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($rows as $i => $row)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>
                    @if (isset($titles[$row->game_id]))
                        <a href="{{ route('games.show', $row->game_id) }}">{{ $titles[$row->game_id] }}</a>
                    @else
                        Гру видалено (id {{ $row->game_id }})
                    @endif
                </td>
                <td>{{ $row->hits }}</td>
                <td>{{ $row->last_visit }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4">Переглядів ігор ще немає.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection
