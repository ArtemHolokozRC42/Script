<?php

namespace App\Http\Middleware;

use App\Models\Game;
use App\Models\Tracker;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisit
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $route = $request->route();
        $game  = $route?->parameter('game');

        // Додаткові параметри в одному JSON-полі: порожні значення відкидаються
        $meta = array_filter([
            'game_id'    => $game instanceof Game ? $game->getKey() : $game,
            'genre'      => $request->string('genre')->toString(),
            'device'     => $this->detectDevice($request->userAgent()),
            'user_agent' => mb_substr((string) $request->userAgent(), 0, 255),
        ], fn ($value) => $value !== null && $value !== '');

        Tracker::create([
            'page'       => $request->path(),
            'ip'         => $request->ip(),
            'method'     => $request->method(),
            'route_name' => $route?->getName(),
            'status'     => $response->getStatusCode(),
            'meta'       => $meta ?: null,
            'visited_at' => now(),
        ]);

        return $response;
    }

    // Визначення типу пристрою за рядком User-Agent
    private function detectDevice(?string $userAgent): string
    {
        $ua = strtolower((string) $userAgent);

        if (str_contains($ua, 'ipad') || str_contains($ua, 'tablet')) {
            return 'tablet';
        }

        if (str_contains($ua, 'mobile') || str_contains($ua, 'android') || str_contains($ua, 'iphone')) {
            return 'mobile';
        }

        return 'desktop';
    }
}
