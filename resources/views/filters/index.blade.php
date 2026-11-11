@extends('layouts.app')

@section('title', 'Мітки')

@section('content')
    <h1>Мітки</h1>
    <p><a href="{{ route('filters.create') }}">Додати мітку</a></p>

    <table>
        <thead>
        <tr><th>#</th><th>Назва</th><th>Опис</th><th>Записів</th><th>Дії</th></tr>
        </thead>
        <tbody>
        @forelse ($filters as $i => $filter)
            <tr>
                <td>{{ $filters->firstItem() + $i }}</td>
                <td>{{ $filter->filter_name }}</td>
                <td>{{ $filter->filter_description }}</td>
                <td>{{ $filter->blogs_count }}</td>
                <td>
                    <a href="{{ route('filters.edit', $filter) }}">Редагувати</a>
                    <form method="POST" action="{{ route('filters.destroy', $filter) }}"
                          style="display:inline" onsubmit="return confirm('Видалити мітку?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Видалити</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="5">Міток немає.</td></tr>
        @endforelse
        </tbody>
    </table>

    {{ $filters->links() }}
@endsection
