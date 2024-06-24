<?php

use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;


Route::get('/', fn() => view('register'));

Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
