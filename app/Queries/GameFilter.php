<?php

namespace App\Queries;

use App\Models\Game;
use Illuminate\Database\Eloquent\Builder;

class GameFilter
{
    // Білий список для сортування: ключ з URL => колонка або псевдонім
    private const SORTABLE = [
        'title'     => 'games.title',
        'price'     => 'games.price',
        'year'      => 'games.release_year',
        'platforms' => 'platforms_count',   // кількість платформ (withCount)
    ];

    public function apply(array $input): Builder
    {
        $query = Game::query()
            ->with('platforms')          // платформи одним додатковим запитом
            ->withCount('platforms');    // кількість платформ підзапитом

        // Пошук за основними полями
        $query->when($input['title'] ?? null, fn (Builder $q, $value) =>
        $q->where('games.title', 'like', "%{$value}%"));

        $query->when($input['developer'] ?? null, fn (Builder $q, $value) =>
        $q->where('games.developer', 'like', "%{$value}%"));

        // Пошук за полем пов'язаної таблиці (зв'язок N:N)
        $query->when($input['platformName'] ?? null, fn (Builder $q, $value) =>
        $q->whereHas('platforms', fn (Builder $related) =>
        $related->where('name', 'like', "%{$value}%")));

        // Фільтр за обраною платформою
        $query->when($input['platform_id'] ?? null, fn (Builder $q, $value) =>
        $q->whereHas('platforms', fn (Builder $related) =>
        $related->whereKey($value)));

        return $this->sort($query, $input['sort'] ?? null);
    }

    private function sort(Builder $query, ?string $sort): Builder
    {
        $desc  = str_starts_with((string) $sort, '-');
        $field = $desc ? substr($sort, 1) : (string) $sort;

        // Усе, чого немає в білому списку, ігнорується
        if (!isset(self::SORTABLE[$field])) {
            return $query->orderBy('games.title')->orderBy('games.id');
        }

        return $query
            ->orderBy(self::SORTABLE[$field], $desc ? 'desc' : 'asc')
            ->orderBy('games.id');
    }
}
