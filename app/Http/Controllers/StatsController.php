<?php

namespace App\Http\Controllers;

use App\Models\Tracker;
use Illuminate\Http\Request;
use App\Models\Game;

class StatsController extends Controller
{
    public function pages(Request $request)
    {
        $type = $request->query('type', 'page');

        if (!in_array($type, ['page', 'ip'], true)) {
            abort(400, 'Невідомий тип групування.');
        }

        $rows = Tracker::query()
            ->selectRaw("{$type}, count(*) as hits, max(visited_at) as last_visit")
            ->groupBy($type)
            ->orderByDesc('hits')
            ->get();

        return view('stats.pages', compact('rows', 'type'));
    }
    public function detail(Request $request)
    {
        $type = $request->query('type', 'page');
        $item = $request->query('item');

        if (!in_array($type, ['page', 'ip'], true)) {
            abort(400, 'Невідомий тип фільтрації.');
        }

        $rows = Tracker::query()
            ->when($item, fn ($query, $value) => $query->where($type, $value))
            ->orderByDesc('visited_at')
            ->paginate(15)
            ->withQueryString();

        return view('stats.detail', compact('rows', 'type', 'item'));
    }
    public function games()
    {
        $rows = Tracker::query()
            ->where('route_name', 'games.show')
            ->where('status', 200)
            ->selectRaw('JSON_UNQUOTE(JSON_EXTRACT(meta, "$.game_id")) as game_id, count(*) as hits, max(visited_at) as last_visit')
            ->groupBy('game_id')
            ->orderByDesc('hits')
            ->limit(10)
            ->get();

        // Назви ігор одним запитом, а не по одному на рядок
        $titles = Game::whereIn('id', $rows->pluck('game_id'))->pluck('title', 'id');

        return view('stats.games', compact('rows', 'titles'));
    }
}
