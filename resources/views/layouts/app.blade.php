<!DOCTYPE html>
<html lang="uk">
<style>
    .field { margin-bottom: 16px; }
    label { display: block; margin-bottom: 4px; }
    input, textarea { width: 100%; padding: 8px; box-sizing: border-box; }
    .error { color: #c0392b; font-size: 14px; margin-top: 4px; }
    button { background: #1b2838; color: #fff; border: 0; padding: 10px 20px; cursor: pointer; }
    button:hover { background: #66c0f4; }
    body { margin: 0; font-family: Arial, sans-serif; background: #f4f6f8; }
    nav { background: #1b2838; padding: 14px 24px; }
    nav a { color: #c7d5e0; text-decoration: none; margin-right: 20px; }
    nav a:hover { color: #66c0f4; }
    main { max-width: 900px; margin: 30px auto; padding: 0 20px; }
    footer { background: #171a21; color: #8f98a0; text-align: center;
        padding: 20px; margin-top: 40px; }
    table { width: 100%; border-collapse: collapse; margin: 16px 0; }
    th, td { border-bottom: 1px solid #ddd; padding: 8px; text-align: left; }
    .pagination { display: flex; gap: 14px; align-items: center; margin: 16px 0; }
    .pagination a { color: #1b2838; }
    .pagination .disabled { color: #999; }
    .pagination .info { color: #555; }
    .filter { margin: 16px 0; }
    .filter select { width: auto; }
    .blog-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 20px; margin: 24px 0; }
    .blog-card { border: 1px solid #ddd; border-radius: 10px; overflow: hidden; background: #fff; transition: transform 0.2s, box-shadow 0.2s; }
    .blog-card:hover { transform: translateY(-4px); box-shadow: 0 6px 16px rgba(0, 0, 0, 0.12); }
    .blog-card-image { width: 100%; height: 180px; object-fit: cover; display: block; }
    .blog-card-body { padding: 16px; }
    .blog-category { font-size: 13px; color: #2563eb; }
    .blog-meta { font-size: 13px; color: #666; }
    .lang-switch { float: right; }
    .lang-switch a { margin-left: 10px; }
    .lang-switch .active-lang { font-weight: bold; border-bottom: 2px solid #66c0f4; }
</style>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'GameHub')</title>
</head>
<body>
<nav>
    <a href="{{ url('/') }}">Головна</a>
    <a href="{{ route('games.index') }}">Каталог ігор</a>
    <a href="{{ url('/library') }}">Бібліотека</a>
    <a href="{{ url('/about') }}">Про платформу</a>
    <a href="{{ url('/contact') }}">Контакти</a>
    <a href="{{ route('country.index') }}">Країни</a>
    <a href="{{ route('blog.index') }}">Блог</a>
    <a href="{{ route('blog.admin') }}">Адмін блогу</a>
    <span class="lang-switch">
    @foreach (config('app.supported_locales') as $code => $label)
            <a href="{{ request()->fullUrlWithQuery(['lang' => $code]) }}"
           @class(['active-lang' => app()->getLocale() === $code])>{{ strtoupper($code) }}</a>
        @endforeach
</span>
</nav>
<main>
    @yield('content')
</main>
<footer>
    <p>&copy; {{ date('Y') }} GameHub — платформа дистрибуції відеоігор</p>
    <p>Виконав: Голокоз Артем Віталійович, група РС-42</p>
    <p>КПІ ім. Ігоря Сікорського</p>
</footer>
</body>
</html>
