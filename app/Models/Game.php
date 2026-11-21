<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Game extends Model
{
    protected $fillable = [
        'title', 'genre', 'developer', 'price', 'release_year', 'description','user_id',
    ];

    public function translations(): HasMany
    {
        return $this->hasMany(GameTranslation::class);
    }

    public function platforms(): BelongsToMany
    {
        return $this->belongsToMany(Platform::class, 'game_platform', 'game_id', 'platform_id');
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
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
