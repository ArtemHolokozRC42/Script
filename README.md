# GameHub — платформа дистрибуції відеоігор

Навчальний вебзастосунок на Laravel 12. Складається з трьох модулів:

- сторінка зворотного зв'язку з валідацією та листом (`/contact`);
- довідник країн: навчальний приклад CRUD (`/country`);
- каталог ігор: CRUD, пагінація та фільтр за жанром (`/games`).

## Вимоги
- PHP 8.4 або новіша з розширеннями `pdo_mysql`, `mbstring`, `fileinfo`, `openssl`
- Composer
- MariaDB або MySQL (наприклад, зі складу XAMPP)

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
3. Запустити MySQL і створити порожню базу даних:
```sql
CREATE DATABASE kpi_lab CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```
4. У файлі `.env` вказати підключення до бази (у зразку за замовчуванням стоїть SQLite, його потрібно замінити):
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
5. Створити таблиці та додати тестові дані:
```
php artisan migrate
php artisan db:seed --class=CountrySeeder
php artisan db:seed --class=GameSeeder
```
Сідери запускайте по одному разу: повторний запуск дасть помилку дублікатів. Щоб почати спочатку,
виконайте `php artisan migrate:fresh` і запустіть сідери знову.

6. Запустити сервер:
```
php artisan serve
```
Сайт доступний за адресою http://127.0.0.1:8000

Файл `.env` не зберігається в репозиторії (там паролі й ключ застосунку), тому кожен розробник
створює його сам із `.env.example`.

## Маршрути

| Метод | Адреса | Призначення |
|---|---|---|
| GET | `/` | головна сторінка |
| GET, POST | `/contact` | форма зворотного зв'язку |
| GET | `/contact/thanks` | сторінка підтвердження |
| resource | `/country` | довідник країн |
| resource | `/games` | каталог ігор |
| GET | `/games?genre=RPG` | лише ігри обраного жанру |

Ресурсні маршрути (`Route::resource`) дають сім адрес: перелік, форма створення, збереження,
перегляд, форма редагування, оновлення, видалення. Повний перелік: `php artisan route:list`.

## База даних

| Таблиця | Поля |
|---|---|
| `country` | `code` (первинний ключ, CHAR 2), `name`, `population` |
| `games` | `id`, `title`, `genre`, `developer`, `price`, `release_year`, `description`, `created_at`, `updated_at` |

Таблиця `country` має нестандартний ключ і не має міток часу, тому модель `Country` задає
`$table`, `$primaryKey`, `$incrementing`, `$keyType` і `$timestamps`.

## Валідація

| Клас | Правила |
|---|---|
| `CountryRequest` | код: рівно 2 символи; назва: до 52 символів; населення: ціле число від 0 |
| `GameRequest` | назва, жанр, розробник: обов'язкові; ціна: число від 0; рік випуску: ціле від 1970; опис: необов'язковий |
| `ContactRequest` | ім'я, email, телефон у форматі `+380XXXXXXXXX`, тема зі списку, повідомлення 10–2000 символів |

## Де що знаходиться

| Компонент | Файл |
|---|---|
| Міграції таблиць | `database/migrations/` |
| Сідери | `database/seeders/CountrySeeder.php`, `GameSeeder.php` |
| Моделі | `app/Models/Country.php`, `Game.php` |
| Контролери | `app/Http/Controllers/CountryController.php`, `GameController.php`, `ContactController.php` |
| Правила валідації | `app/Http/Requests/` |
| Фільтр за жанром | `GameController::index()` |
| Представлення | `resources/views/country/`, `games/`, `contact.blade.php` |
| Загальний макет і меню | `resources/views/layouts/app.blade.php` |
| Лист зворотного зв'язку | `app/Mail/ContactMessage.php`, `resources/views/emails/contact.blade.php` |
| Маршрути | `routes/web.php` |

## Як працює фільтр за жанром

`$request->query('genre')` читає параметр з адреси. Метод `when()` додає умову `where('genre', ...)`
до Eloquent-запиту лише якщо параметр заданий, тому без нього сторінка показує всі ігри.
Метод `withQueryString()` зберігає фільтр у посиланнях пагінації.

## Як перевірити

1. `/country`: список країн по 5 на сторінці, друга сторінка, перегляд, додавання, редагування, видалення.
2. `/games`: каталог ігор; `/games?genre=RPG` показує лише RPG; після переходу на другу сторінку фільтр лишається.
3. Некоректні дані в будь-якій формі: помилки відображаються біля полів, введені значення не зникають.
4. `/contact`: після успішної відправки лист записується в `storage/logs/laravel.log` (режим `MAIL_MAILER=log`).
