<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');

    Route::get('language/{locale}', [LanguageController::class, 'switch'])->name('language.switch');
    Route::resource('blogs', BlogController::class)->names('blog');
});

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
