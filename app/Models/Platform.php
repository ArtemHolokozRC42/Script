<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Platform extends Model
{
    protected $fillable = ['name', 'description'];

    public function games(): BelongsToMany
    {
        return $this->belongsToMany(Game::class, 'game_platform', 'platform_id', 'game_id');
    }
}
