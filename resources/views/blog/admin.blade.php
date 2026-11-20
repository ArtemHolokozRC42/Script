@extends('layouts.app')

@section('title', 'Адміністрування блогу')

@section('content')
    @php
        // Посилання для заголовка: перший клік = за зростанням, повторний = за спаданням
        $sortLink = function (string $field) {
            $next = request('sort') === $field ? '-' . $field : $field;

            return route('blog.admin', array_merge(request()->except('sort', 'page'), ['sort' => $next]));
        };

        // Стрілка поруч із назвою стовпця, за яким виконується сортування
        $arrow = fn (string $field) => match (request('sort')) {
            $field       => ' ↑',
            '-' . $field => ' ↓',
            default      => '',
        };
    @endphp
    <form method="GET" action="{{ route('blog.admin') }}" class="search-form">
        <div class="field">
            <label for="title">Заголовок</label>
            <input id="title" name="title" type="text" value="{{ request('title') }}" placeholder="Частина заголовка">
        </div>
        <div class="field">
            <label for="categoryName">Назва категорії</label>
            <input id="categoryName" name="categoryName" type="text" value="{{ request('categoryName') }}">
        </div>
        <div class="field">
            <label for="category_id">Категорія</label>
            <select id="category_id" name="category_id">
                <option value="">Усі категорії</option>
                @foreach ($categories as $id => $name)
                    <option value="{{ $id }}" @selected(request('category_id') == $id)>{{ $name }}</option>
                @endforeach
            </select>
        </div>
        <div class="field">
            <label for="filter_id">Мітка</label>
            <select id="filter_id" name="filter_id">
                <option value="">Усі мітки</option>
                @foreach ($filters as $id => $name)
                    <option value="{{ $id }}" @selected(request('filter_id') == $id)>{{ $name }}</option>
                @endforeach
            </select>
        </div>
        <input type="hidden" name="sort" value="{{ request('sort') }}">
        <button type="submit">Застосувати</button>
        <a href="{{ route('blog.admin') }}">Скинути фільтри</a>
    </form>
    <h1>Адміністрування блогу</h1>

    <p><a href="{{ route('blog.create') }}">Додати запис</a></p>

    <table>
        <thead>
        <tr>
            <th>#</th>
            <th><a href="{{ $sortLink('title') }}">Заголовок{{ $arrow('title') }}</a></th>
            <th><a href="{{ $sortLink('categoryName') }}">Категорія{{ $arrow('categoryName') }}</a></th>
            <th>Мітки</th>
            <th><a href="{{ $sortLink('created') }}">Створено{{ $arrow('created') }}</a></th>
            <th>Дії</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($blogs as $i => $blog)
            <tr>
                <td>{{ $blogs->firstItem() + $i }}</td>
                <td><a href="{{ route('blog.show', $blog) }}">{{ $blog->title }}</a></td>
                <td>{{ $blog->category?->category_name ?? '—' }}</td>
                <td>
                    @forelse ($blog->filters as $filter)
                        <span class="tag">{{ $filter->filter_name }}</span>
                    @empty
                        —
                    @endforelse
                </td>
                <td>{{ $blog->dt_created->format('d.m.Y H:i') }}</td>
                <td>
                    <a href="{{ route('blog.edit', $blog) }}">Редагувати</a>
                    <form method="POST" action="{{ route('blog.destroy', $blog) }}"
                          style="display:inline" onsubmit="return confirm('Видалити запис?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Видалити</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6">Записів не знайдено.</td></tr>
        @endforelse
        </tbody>
    </table>

    {{ $blogs->links() }}
@endsection
