<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $supported = array_keys(config('app.supported_locales'));

        // Параметр ?lang=..., а якщо його немає, мова із сесії
        $lang = $request->query('lang', $request->session()->get('lang'));

        if (is_string($lang) && in_array($lang, $supported, true)) {
            $request->session()->put('lang', $lang);
            app()->setLocale($lang);
        }

        return $next($request);
    }
}
