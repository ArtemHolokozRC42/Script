<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $games = $user->games()
            ->withCount('platforms')
            ->latest()
            ->limit(10)
            ->get();

        return view('dashboard', [
            'user'       => $user,
            'games'      => $games,
            'gamesTotal' => $user->games()->count(),
        ]);
    }
}
