<!DOCTYPE html>
<html lang="uk">
<style>
    body { margin: 0; font-family: Arial, sans-serif; background: #f4f6f8; }
    nav { background: #1b2838; padding: 14px 24px; }
    nav a { color: #c7d5e0; text-decoration: none; margin-right: 20px; }
    nav a:hover { color: #66c0f4; }
    main { max-width: 900px; margin: 30px auto; padding: 0 20px; }
    footer { background: #171a21; color: #8f98a0; text-align: center;
        padding: 20px; margin-top: 40px; }
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
