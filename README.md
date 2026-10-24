# GameHub — платформа дистрибуції відеоігор

Навчальний вебзастосунок на Laravel 12. Містить сторінку зворотного зв'язку з валідацією та листом,
довідник країн (навчальний приклад) і каталог ігор з CRUD, пагінацією та фільтром за жанром.

## Вимоги
- PHP 8.4 або новіша (розширення `pdo_mysql`, `mbstring`, `fileinfo`, `openssl`)
- Composer
- MariaDB / MySQL (наприклад, зі складу XAMPP)

## Встановлення та запуск
1. Встановити залежності:
```
composer install
```
2. Створити файл налаштувань і ключ застосунку:
```
copy .env.example .env
php artisan key:generate
```
3. Створити порожню базу даних (запустивши MySQL):
```
CREATE DATABASE kpi_lab CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```
4. У `.env` вказати параметри підключення:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kpi_lab
DB_USERNAME=root
DB_PASSWORD=
SESSION_DRIVER=file
MAIL_MAILER=log
```
5. Виконати міграції та наповнити таблиці тестовими даними:
```
php artisan migrate
php artisan db:seed --class=CountrySeeder
php artisan db:seed --class=GameSeeder
```
6. Запустити сервер:
```
php artisan serve
```
Сайт доступний за адресою http://127.0.0.1:8000

## Маршрути
| Метод | Адреса | Призначення |
|---|---|---|
| GET | `/` | головна сторінка |
| GET, POST | `/contact` | форма зворотного зв'язку |
| GET | `/contact/thanks` | сторінка підтвердження |
| resource | `/country` | довідник країн (перелік, перегляд, створення, редагування, видалення) |
| resource | `/games` | каталог ігор (CRUD); фільтр `?genre=RPG` |

## База даних
| Таблиця | Поля | Призначення |
|---|---|---|
| `country` | `code` (PK, CHAR 2), `name`, `population` | довідник країн |
| `games` | `id`, `title`, `genre`, `developer`, `price`, `release_year`, `description`, `created_at`, `updated_at` | каталог ігор |

Структура таблиць описана міграціями в `database/migrations`, початкові дані — сідерами в `database/seeders`.

## Валідація
- `CountryRequest`: код — рівно 2 символи, назва до 52 символів, населення — ціле число від 0.
- `GameRequest`: назва, жанр, розробник — обов'язкові; ціна — число від 0; рік випуску — ціле від 1970.
- `ContactRequest`: ім'я, email, телефон у форматі `+380XXXXXXXXX`, тема зі списку, повідомлення 10–2000 символів.

## Структура
```
app/Models/                  моделі Country, Game
app/Http/Controllers/        CountryController, GameController, ContactController
app/Http/Requests/           CountryRequest, GameRequest, ContactRequest
database/migrations/         міграції таблиць
database/seeders/            сідери CountrySeeder, GameSeeder
resources/views/             Blade-представлення (country, games, layouts, emails)
routes/web.php               маршрути
```

## Як перевірити
1. `/country`: список країн, друга сторінка пагінації, додавання, редагування, видалення.
2. `/games`: каталог ігор; `/games?genre=RPG` — лише ігри обраного жанру; фільтр зберігається при переході між сторінками.
3. Некоректні дані у формах: помилки біля полів, введені значення не втрачаються.
