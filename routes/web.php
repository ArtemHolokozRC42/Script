<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\StatsController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/contact', [ContactController::class, 'showContactForm'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'submitContactForm'])->name('contact.send');
Route::get('/contact/thanks', [ContactController::class, 'showContactThanks'])->name('contact.thanks');
Route::resource('country', CountryController::class);
Route::resource('games', GameController::class);
Route::get('/stats', [StatsController::class, 'pages'])->name('stats.pages');
Route::get('/stats/detail', [StatsController::class, 'detail'])->name('stats.detail');
Route::get('/phpinfo', fn () => phpinfo());
Route::get('/stats/games', [StatsController::class, 'games'])->name('stats.games');
