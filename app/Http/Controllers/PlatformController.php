<?php

namespace App\Http\Controllers;

use App\Models\Platform;

class PlatformController extends Controller
{
    public function index()
    {
        $platforms = Platform::withCount('games')->orderBy('name')->get();

        return view('platforms.index', compact('platforms'));
    }
}
