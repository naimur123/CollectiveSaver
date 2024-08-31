<?php

use App\Http\Controllers\v1\FundController;
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
    Route::get('/group_create', [GroupController::class, 'create'])->name('group.create');
    Route::post('/group_create', [GroupController::class, 'store'])->name('group.store');
    Route::get('/group_edit/{id}', [GroupController::class, 'edit'])->name('group.edit');

    /* Group Fund */
    Route::get('/group_fund',[FundController::class, 'index'])->name('group_fund');
    Route::get('/group_fund_create',[FundController::class, 'create'])->name('group.fund.create');
    Route::post('/group_fund_create',[FundController::class, 'index'])->name('group.fund.store');
    Route::get('/group_fund_individual',[FundController::class, 'group_fund_individual'])->name('group_fund_individual');
});

