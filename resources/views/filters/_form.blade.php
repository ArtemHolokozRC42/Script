<div class="field">
    <label for="filter_name">Назва</label>
    <input id="filter_name" name="filter_name" type="text"
           value="{{ old('filter_name', $filter->filter_name ?? '') }}">
    @error('filter_name')<div class="error">{{ $message }}</div>@enderror
</div>

<div class="field">
    <label for="filter_description">Опис</label>
    <textarea id="filter_description" name="filter_description" rows="3">{{ old('filter_description', $filter->filter_description ?? '') }}</textarea>
    @error('filter_description')<div class="error">{{ $message }}</div>@enderror
</div>
