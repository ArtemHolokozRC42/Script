# GameHub — платформа дистрибуції відеоігор

Навчальний вебзастосунок на Laravel 12. Реалізовано сторінку зворотного зв'язку
з валідацією форми та надсиланням листа.

## Вимоги
- PHP 8.4
- Composer

## Встановлення та запуск
```
composer install
copy .env.example .env
php artisan key:generate
php artisan serve
```
Сайт буде доступний за адресою http://127.0.0.1:8000

У файлі `.env` для роботи форми мають бути встановлені:
```
SESSION_DRIVER=file
MAIL_MAILER=log
```
З `MAIL_MAILER=log` лист не надсилається, а записується у `storage/logs/laravel.log`.
Для реальної відправки налаштуйте SMTP (`MAIL_HOST`, `MAIL_PORT`, `MAIL_USERNAME`,
`MAIL_PASSWORD`, `MAIL_FROM_ADDRESS`).

## Маршрути
| Метод | Адреса | Метод контролера | Призначення |
|---|---|---|---|
| GET | `/` | — | головна сторінка |
| GET | `/contact` | `showContactForm` | форма зворотного зв'язку |
| POST | `/contact` | `submitContactForm` | обробка форми, відправка листа |
| GET | `/contact/thanks` | `showContactThanks` | сторінка підтвердження |

## Поля форми та валідація
| Поле | Правила |
|---|---|
| `name` | обов'язкове, 2-100 символів |
| `email` | обов'язкове, коректний email |
| `phone` | обов'язкове, формат `+380XXXXXXXXX` (пробіли й дефіси ігноруються) |
| `topic` | обов'язкове, одна з тем: purchase, activation, refund, other |
| `message` | обов'язкове, 10-2000 символів |

Правила та повідомлення про помилки: `app/Http/Requests/ContactRequest.php`.

## Структура
```
app/Http/Controllers/ContactController.php   контролер
app/Http/Requests/ContactRequest.php         валідація форми
app/Mail/ContactMessage.php                  лист
resources/views/layouts/app.blade.php        загальний макет
resources/views/contact.blade.php            форма
resources/views/contact-thanks.blade.php     сторінка підтвердження
resources/views/emails/contact.blade.php     шаблон листа
routes/web.php                               маршрути
```

## Як перевірити
1. Відкрити `/contact`, надіслати порожню форму: помилки біля полів.
2. Ввести некоректний email або телефон: помилка, інші значення збережені.
3. Ввести коректні дані: сторінка «Дякуємо», лист у `storage/logs/laravel.log`.
