<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameTranslationController extends Controller
{
    public function edit(Game $game)
    {
        $game->load('translations');

        return view('games.translations', [
            'game'    => $game,
            'locales' => config('app.supported_locales'),
        ]);
    }

    public function update(Request $request, Game $game)
    {
        $locales = array_keys(config('app.supported_locales'));

        $data = $request->validate([
            'translations'               => ['required', 'array'],
            'translations.*.title'       => ['nullable', 'string', 'max:150'],
            'translations.*.description' => ['nullable', 'string', 'max:2000'],
        ]);

        foreach ($data['translations'] as $locale => $fields) {
            if (!in_array($locale, $locales, true)) {
                continue;
            }

            // Порожня назва: переклад цією мовою видаляється
            if (blank($fields['title'] ?? null)) {
                $game->translations()->where('locale', $locale)->delete();
                continue;
            }

            $game->translations()->updateOrCreate(
                ['locale' => $locale],
                [
                    'title'       => $fields['title'],
                    'description' => $fields['description'] ?? null,
                ]
            );
        }

        return redirect()->route('games.show', $game);
    }
}
