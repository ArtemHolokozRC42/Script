@extends('layouts.app')

@section('title', 'Переклади гри')

@section('content')
    <h1>Переклади: {{ $game->title }}</h1>
    <p>Порожня назва означає, що переклад цією мовою видаляється й показується основна мова.</p>

    <form method="POST" action="{{ route('games.translations.update', $game) }}" novalidate>
        @csrf
        @method('PUT')

        @foreach ($locales as $code => $label)
            @php($t = $game->translation($code))

            <fieldset>
                <legend>{{ $label }} ({{ $code }})</legend>

                <div class="field">
                    <label for="title_{{ $code }}">Назва</label>
                    <input id="title_{{ $code }}" type="text"
                           name="translations[{{ $code }}][title]"
                           value="{{ old('translations.'.$code.'.title', $t?->title) }}">
                    @error('translations.'.$code.'.title')<div class="error">{{ $message }}</div>@enderror
                </div>

                <div class="field">
                    <label for="description_{{ $code }}">Опис</label>
                    <textarea id="description_{{ $code }}" rows="3"
                              name="translations[{{ $code }}][description]">{{ old('translations.'.$code.'.description', $t?->description) }}</textarea>
                    @error('translations.'.$code.'.description')<div class="error">{{ $message }}</div>@enderror
                </div>
            </fieldset>
        @endforeach

        <button type="submit">Зберегти переклади</button>
        <a href="{{ route('games.show', $game) }}">Скасувати</a>
    </form>
@endsection
