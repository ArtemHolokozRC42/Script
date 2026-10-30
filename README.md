## Трекер відвідувань

Middleware `TrackVisit` записує кожне звернення до сторінок застосунку в таблицю `tracker`.

| Поле | Опис |
|---|---|
| `page`, `ip`, `status`, `visited_at` | адреса, IP, код відповіді, час |
| `method`, `route_name` | HTTP-метод і ім'я маршруту |
| `meta` (JSON) | додаткові параметри: `game_id`, `genre`, `device`, `user_agent` |

Сторінки статистики: `/stats?type=page|ip` (зведення), `/stats/detail` (детально з пагінацією),
`/stats/games` (найпопулярніші ігри). Підключення: `bootstrap/app.php`, група `web`.
Нові параметри додаються в масив `$meta` в `TrackVisit` без зміни структури таблиці.
