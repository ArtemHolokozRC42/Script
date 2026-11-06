<?php

namespace Database\Seeders;

use App\Models\Game;
use Illuminate\Database\Seeder;

class GameTranslationSeeder extends Seeder
{
    public function run(): void
    {
        // Ключ: назва гри основною мовою (games.title); значення: [назва, опис]
        $data = [
            'The Witcher 3: Wild Hunt' => [
                'uk' => ['Відьмак 3: Дике Полювання', 'Рольова гра з відкритим світом: мисливець на чудовиськ Геральт шукає зниклу названу доньку серед політичних інтриг і магії.'],
                'en' => ['The Witcher 3: Wild Hunt', 'An open-world RPG in which the monster hunter Geralt searches for his missing adoptive daughter amid political intrigue and magic.'],
            ],
            'Cyberpunk 2077' => [
                'uk' => ['Кіберпанк 2077', 'Рольовий бойовик від першої особи про найманця в мегаполісі майбутнього, де технології змінюють тіло й свідомість.'],
                'en' => ['Cyberpunk 2077', 'A first-person action RPG about a mercenary in a megacity of the future where technology reshapes body and mind.'],
            ],
            'Hades' => [
                'uk' => ['Аїд', 'Динамічний рогалик, у якому Загрей, син володаря царства мертвих, намагається вирватися з підземного світу.'],
                'en' => ['Hades', 'A fast-paced roguelike in which Zagreus, the son of the lord of the dead, tries to escape the Underworld.'],
            ],
            'Stardew Valley' => [
                'uk' => ['Долина Стардью', 'Затишний симулятор ферми: обробляйте землю, розводьте тварин і дружіть із мешканцями містечка.'],
                'en' => ['Stardew Valley', 'A cozy farming simulator: tend crops, raise animals and befriend the townsfolk.'],
            ],
            'Elden Ring' => [
                'uk' => ['Елден Рінг', 'Екшен-RPG у величезному відкритому світі від авторів Dark Souls за участі Джорджа Р. Р. Мартіна.'],
                'en' => ['Elden Ring', 'An action RPG in a vast open world from the makers of Dark Souls, with world-building by George R. R. Martin.'],
            ],
            'Portal 2' => [
                'uk' => ['Портал 2', 'Головоломка від першої особи, у якій тестові камери проходять за допомогою пристрою для створення порталів.'],
                'en' => ['Portal 2', 'A first-person puzzle game in which you solve test chambers with a portal-creating device.'],
            ],
            'DOOM Eternal' => [
                'uk' => ['ДУМ: Вічний', 'Швидкісний шутер від першої особи: знищуйте демонічні орди, постійно рухаючись і комбінуючи зброю.'],
                'en' => ['DOOM Eternal', 'A fast-paced first-person shooter about wiping out demonic hordes by staying in constant motion and combining weapons.'],
            ],
        ];

        foreach ($data as $mainTitle => $locales) {
            $game = Game::where('title', $mainTitle)->first();

            if (!$game) {
                continue;
            }

            foreach ($locales as $locale => [$title, $description]) {
                $game->translations()->updateOrCreate(
                    ['locale' => $locale],
                    ['title' => $title, 'description' => $description]
                );
            }
        }

        // Гра без перекладів: показує основну мову (для перевірки запасного варіанту)
        Game::where('title', 'Celeste')->update([
            'description' => 'A challenging platformer about climbing Celeste Mountain.',
        ]);
    }
}
