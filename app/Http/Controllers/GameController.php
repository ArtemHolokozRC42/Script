<?php

namespace App\Http\Controllers;

use App\Http\Requests\GameRequest;
use App\Models\Game;
use App\Models\Platform;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Queries\GameFilter;

class GameController extends Controller
{
    public function admin(Request $request, GameFilter $filter)
    {
        $input = $request->validate([
            'title'        => ['nullable', 'string', 'max:150'],
            'developer'    => ['nullable', 'string', 'max:100'],
            'platformName' => ['nullable', 'string', 'max:100'],
            'platform_id'  => ['nullable', 'integer', 'exists:platforms,id'],
            'sort'         => ['nullable', 'string', 'max:30'],
        ]);

        $games = $filter->apply($input)
            ->paginate(5)
            ->withQueryString();

        return view('games.admin', [
            'games'     => $games,
            'platforms' => Platform::orderBy('name')->pluck('name', 'id'),
        ]);
    }
    public function index(Request $request)
    {
        $genre = $request->query('genre');

        $games = Game::query()
            ->with('translations')
            ->withCount('platforms')
            ->when($genre, fn ($query) => $query->where('genre', $genre))
            ->orderBy('title')
            ->paginate(5)
            ->withQueryString();

        $genres = Game::query()->distinct()->orderBy('genre')->pluck('genre');

        return view('games.index', compact('games', 'genres', 'genre'));
    }

    public function create()
    {
        return view('games.create', [
            'platforms' => Platform::orderBy('name')->pluck('name', 'id'),
        ]);
    }

    public function store(GameRequest $request)
    {
        $data = $request->validated();

        $game = Game::create(Arr::except($data, ['platforms']));
        $game->platforms()->sync($data['platforms'] ?? []);

        return redirect()->route('games.index');
    }

    public function show(Game $game)
    {
        $game->load('translations', 'platforms');

        return view('games.show', compact('game'));
    }

    public function edit(Game $game)
    {
        $game->load('platforms');

        return view('games.edit', [
            'game'      => $game,
            'platforms' => Platform::orderBy('name')->pluck('name', 'id'),
            'selected'  => $game->platforms->pluck('id')->all(),
        ]);
    }

    public function update(GameRequest $request, Game $game)
    {
        $data = $request->validated();

        $game->update(Arr::except($data, ['platforms']));
        $game->platforms()->sync($data['platforms'] ?? []);

        return redirect()->route('games.index');
    }

    public function destroy(Game $game)
    {
        $game->delete();

        return redirect()->route('games.index');
    }
}
