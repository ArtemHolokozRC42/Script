<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Platform;
use Illuminate\Database\Seeder;

class PlatformSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['PC', 'PlayStation 5', 'Xbox Series X|S', 'Nintendo Switch', 'Steam Deck'] as $name) {
            Platform::firstOrCreate(['name' => $name]);
        }

        // Назва гри (games.title) => платформи
        $map = [
            'The Witcher 3: Wild Hunt' => ['PC', 'PlayStation 5', 'Xbox Series X|S', 'Nintendo Switch'],
            'Cyberpunk 2077'           => ['PC', 'PlayStation 5', 'Xbox Series X|S'],
            'Hades'                    => ['PC', 'PlayStation 5', 'Xbox Series X|S', 'Nintendo Switch'],
            'Stardew Valley'           => ['PC', 'PlayStation 5', 'Nintendo Switch', 'Steam Deck'],
            'Elden Ring'               => ['PC', 'PlayStation 5', 'Xbox Series X|S'],
            'Portal 2'                 => ['PC', 'Steam Deck'],
            'DOOM Eternal'             => ['PC', 'PlayStation 5', 'Xbox Series X|S', 'Nintendo Switch'],
            'Celeste'                  => ['PC', 'Nintendo Switch'],
        ];

        foreach ($map as $title => $platformNames) {
            $game = Game::where('title', $title)->first();

            if (!$game) {
                continue;
            }

            $ids = Platform::whereIn('name', $platformNames)->pluck('id')->all();
            $game->platforms()->sync($ids);
        }
    }
}
