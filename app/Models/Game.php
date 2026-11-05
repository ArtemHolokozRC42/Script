<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Game extends Model
{
    protected $fillable = [
        'title', 'genre', 'developer', 'price', 'release_year', 'description',
    ];

    public function translations(): HasMany
    {
        return $this->hasMany(GameTranslation::class);
    }

    // Переклад на вказану (або поточну) мову; null, якщо його немає
    public function translation(?string $locale = null): ?GameTranslation
    {
        $locale ??= app()->getLocale();

        return $this->translations->firstWhere('locale', $locale);
    }

    // Назва обраною мовою; якщо перекладу немає, основна (games.title)
    public function localizedTitle(?string $locale = null): string
    {
        return $this->translation($locale)?->title ?: $this->title;
    }

    // Опис обраною мовою; якщо перекладу немає, основний (games.description)
    public function localizedDescription(?string $locale = null): ?string
    {
        return $this->translation($locale)?->description ?: $this->description;
    }
}
