<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GameTranslation extends Model
{
    protected $fillable = ['locale', 'title', 'description'];

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }
}
