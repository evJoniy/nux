<?php

use App\Http\Controllers\InteractionController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;


Route::get('/', fn() => view('register'))->name('register');

Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::get('/token/{token}', [InteractionController::class, 'show'])->name('interact.show');

Route::prefix('interact/{token}')->group(function () {
    Route::get('/', [InteractionController::class, 'show'])->name('interact.show');
    Route::post('/regenerate', [InteractionController::class, 'regenerate'])->name('interact.regenerate');
    Route::post('/deactivate', [InteractionController::class, 'deactivate'])->name('interact.deactivate');
    Route::get('/lucky', [InteractionController::class, 'lucky'])->name('interact.lucky');
    Route::get('/history', [InteractionController::class, 'history'])->name('interact.history');
});

