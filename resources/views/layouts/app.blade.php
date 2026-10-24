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
    .pagination { display: flex; gap: 6px; list-style: none; padding: 0; }
    .page-link { display: block; padding: 6px 12px; border: 1px solid #ccc; text-decoration: none; color: #1b2838; }
    .active .page-link { background: #1b2838; color: #fff; }
    .disabled .page-link { color: #999; }
</style>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'GameHub')</title>
</head>
<body>
<nav>
    <a href="{{ url('/') }}">Головна</a>
    <a href="{{ url('/catalog') }}">Каталог ігор</a>
    <a href="{{ url('/library') }}">Бібліотека</a>
    <a href="{{ url('/about') }}">Про платформу</a>
    <a href="{{ url('/contact') }}">Контакти</a>
    <a href="{{ route('country.index') }}">Країни</a>
</nav>
<main>
    @yield('content')
</main>
<footer>
    <p>&copy; {{ date('Y') }} GameHub — платформа дистрибуції відеоігор</p>
    <p>Виконав: Голокоз Артем Віталійович</p>
    <p>КПІ ім. Ігоря Сікорського</p>
</footer>
</body>
</html>
