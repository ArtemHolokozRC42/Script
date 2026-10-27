<?php

namespace Database\Seeders;

use App\Models\Game;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    public function run(): void
    {
        $games = [
            ['The Witcher 3: Wild Hunt', 'RPG', 'CD Projekt Red', 19.99, 2015],
            ['Cyberpunk 2077', 'RPG', 'CD Projekt Red', 29.99, 2020],
            ['Hades', 'Roguelike', 'Supergiant Games', 24.99, 2020],
            ['Stardew Valley', 'Simulation', 'ConcernedApe', 14.99, 2016],
            ['Elden Ring', 'RPG', 'FromSoftware', 59.99, 2022],
            ['Portal 2', 'Puzzle', 'Valve', 9.99, 2011],
            ['DOOM Eternal', 'Shooter', 'id Software', 39.99, 2020],
            ['Celeste', 'Platformer', 'Maddy Makes Games', 19.99, 2018],
        ];

        foreach ($games as [$title, $genre, $developer, $price, $year]) {
            Game::create([
                'title'        => $title,
                'genre'        => $genre,
                'developer'    => $developer,
                'price'        => $price,
                'release_year' => $year,
            ]);
        }
    }
}
