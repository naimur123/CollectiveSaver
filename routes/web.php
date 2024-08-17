<?php

use App\Http\Controllers\v1\GroupController;
use App\Http\Controllers\v1\LoginController;
use Illuminate\Support\Facades\Route;


Route::get('/',function(){
   return  redirect('login');
});
Route::get('/register', [LoginController::class, 'registerForm']);
Route::post('/register', [LoginController::class, 'register'])->name('register');
Route::get('/login', [LoginController::class, 'loginForm']);
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::middleware(['valid_user', 'audit_trail'])->group(function(){
    Route::get('/home',[LoginController::class, 'dashboard'])->name('home');
    Route::get('/logout',[LoginController::class, 'logout'])->name('logout');

    /* Groups */
    Route::get('/groups', [GroupController::class, 'index'])->name('groups');
});

