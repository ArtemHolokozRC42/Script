<div class="field">
    <label for="title">Назва</label>
    <input id="title" name="title" type="text" value="{{ old('title', $game->title ?? '') }}">
    @error('title')<div class="error">{{ $message }}</div>@enderror
</div>

<div class="field">
    <label for="genre">Жанр</label>
    <input id="genre" name="genre" type="text" value="{{ old('genre', $game->genre ?? '') }}">
    @error('genre')<div class="error">{{ $message }}</div>@enderror
</div>

<div class="field">
    <label for="developer">Розробник</label>
    <input id="developer" name="developer" type="text" value="{{ old('developer', $game->developer ?? '') }}">
    @error('developer')<div class="error">{{ $message }}</div>@enderror
</div>

<div class="field">
    <label for="price">Ціна ($)</label>
    <input id="price" name="price" type="number" step="0.01" min="0" value="{{ old('price', $game->price ?? '') }}">
    @error('price')<div class="error">{{ $message }}</div>@enderror
</div>

<div class="field">
    <label for="release_year">Рік випуску</label>
    <input id="release_year" name="release_year" type="number" value="{{ old('release_year', $game->release_year ?? '') }}">
    @error('release_year')<div class="error">{{ $message }}</div>@enderror
</div>

<div class="field">
    <label for="description">Опис</label>
    <textarea id="description" name="description" rows="4">{{ old('description', $game->description ?? '') }}</textarea>
    @error('description')<div class="error">{{ $message }}</div>@enderror
</div>
<div class="field">
    <label for="platforms">Платформи</label>
    <select id="platforms" name="platforms[]" multiple>
        @foreach ($platforms as $id => $name)
            <option value="{{ $id }}" @selected(in_array($id, old('platforms', $selected ?? [])))>
                {{ $name }}
            </option>
        @endforeach
    </select>
    @error('platforms')<div class="error">{{ $message }}</div>@enderror
    @error('platforms.*')<div class="error">{{ $message }}</div>@enderror
</div>
