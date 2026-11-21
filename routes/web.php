<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\GameTranslationController;
use App\Http\Controllers\PlatformController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StatsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// ---------- ЗАХИЩЕНІ МАРШРУТИ (потрібен вхід, middleware auth) ----------
Route::middleware('auth')->group(function () {
    // Особистий кабінет і профіль
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Користувачі та статистика відвідувань
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/stats', [StatsController::class, 'pages'])->name('stats.pages');
    Route::get('/stats/detail', [StatsController::class, 'detail'])->name('stats.detail');
    Route::get('/stats/games', [StatsController::class, 'games'])->name('stats.games');

    // Ігри: керування (створення, редагування, видалення, адмінка, переклади)
    Route::get('/games/admin', [GameController::class, 'admin'])->name('games.admin');
    Route::resource('games', GameController::class)->except(['index', 'show']);
    Route::get('/games/{game}/translations', [GameTranslationController::class, 'edit'])
        ->name('games.translations.edit');
    Route::put('/games/{game}/translations', [GameTranslationController::class, 'update'])
        ->name('games.translations.update');

    // Блог: адмінка, мітки запису, зміни
    Route::get('/blog/admin', [BlogController::class, 'admin'])->name('blog.admin');
    Route::get('/blog/{blog}/tags', [BlogController::class, 'tags'])->name('blog.tags');
    Route::post('/blog/{blog}/tags', [BlogController::class, 'tagsStore'])->name('blog.tags.store');
    Route::resource('blog', BlogController::class)->except(['index', 'show']);

    // Довідник міток та зміни довідника країн
    Route::resource('filters', FilterController::class)->except(['show']);
    Route::resource('country', CountryController::class)->except(['index', 'show']);
});

// ---------- ПУБЛІЧНІ МАРШРУТИ ----------
Route::get('/', function () {
    return view('welcome');
});

Route::get('/contact', [ContactController::class, 'showContactForm'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'submitContactForm'])->name('contact.send');
Route::get('/contact/thanks', [ContactController::class, 'showContactThanks'])->name('contact.thanks');

Route::get('/platforms', [PlatformController::class, 'index'])->name('platforms.index');

Route::get('/games', [GameController::class, 'index'])->name('games.index');
Route::get('/games/{game}', [GameController::class, 'show'])->name('games.show');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{blog}', [BlogController::class, 'show'])->name('blog.show');

Route::get('/country', [CountryController::class, 'index'])->name('country.index');
Route::get('/country/{country}', [CountryController::class, 'show'])->name('country.show');

// Маршрути автентифікації Breeze: login, register, logout, відновлення пароля
require __DIR__ . '/auth.php';
