<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('login', [UserController::class, 'showLoginForm'])->name('login');

Route::post('login', [UserController::class, 'login']);

Route::post('logout', [UserController::class, 'logout'])->name('logout');

Route::get('register', [UserController::class, 'showRegistrationForm'])->name('register');

Route::post('register', [UserController::class, 'register']);


Route::middleware('auth')->group(function () {
  Route::resource("clients", ClientController::class);
});