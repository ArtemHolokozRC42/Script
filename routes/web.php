<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CountryController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/contact', [ContactController::class, 'showContactForm'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'submitContactForm'])->name('contact.send');
Route::get('/contact/thanks', [ContactController::class, 'showContactThanks'])->name('contact.thanks');
Route::resource('country', CountryController::class);
