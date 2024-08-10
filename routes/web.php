<?php

use App\Http\Controllers\v1\LoginController;
use Illuminate\Support\Facades\Route;


Route::get('/login', [LoginController::class, 'loginForm']);
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/register', [LoginController::class, 'registerForm']);
Route::post('/register', [LoginController::class, 'register'])->name('register');
