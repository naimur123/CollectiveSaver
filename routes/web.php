<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'loginform']);
Route::post('/login', [LoginController::class, 'login'])->name('login');
