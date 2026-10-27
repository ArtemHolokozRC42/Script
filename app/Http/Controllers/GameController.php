<?php

namespace App\Http\Controllers;

use App\Http\Requests\GameRequest;
use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    // Перелік ігор із необов'язковим фільтром ?genre=RPG та пагінацією
    public function index(Request $request)
    {
        $genre = $request->query('genre');

        $games = Game::query()
            ->when($genre, fn ($query) => $query->where('genre', $genre))
            ->orderBy('title')
            ->paginate(5)
            ->withQueryString();

        $genres = Game::query()->distinct()->orderBy('genre')->pluck('genre');

        return view('games.index', compact('games', 'genres', 'genre'));
    }

    public function create()
    {
        return view('games.create');
    }

    public function store(GameRequest $request)
    {
        Game::create($request->validated());

        return redirect()->route('games.index');
    }

    public function show(Game $game)
    {
        return view('games.show', compact('game'));
    }

    public function edit(Game $game)
    {
        return view('games.edit', compact('game'));
    }

    public function update(GameRequest $request, Game $game)
    {
        $game->update($request->validated());

        return redirect()->route('games.index');
    }

    public function destroy(Game $game)
    {
        $game->delete();

        return redirect()->route('games.index');
    }
}
