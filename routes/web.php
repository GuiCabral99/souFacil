<?php

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Auth
Route::get('login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('login', [UserController::class, 'login']);
Route::post('logout', [UserController::class, 'logout'])->name('logout');

Route::get('register', [UserController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [UserController::class, 'register']);

Route::put('/user', [UserController::class, 'update'])->name('user.update');
Route::delete('/user', [UserController::class, 'destroy'])->name('user.destroy');

// Rotas autenticadas
Route::middleware('auth')->group(function () {
    Route::resource("clients", ClientController::class);

    Route::resource("sales", SaleController::class);
    Route::patch('/sales/{sale}/toggle-delivered', [SaleController::class, 'toggleDelivered'])->name('sales.toggleDelivered');

    Route::get("/clients/{client}/sales", [SaleController::class, 'clientSales'])->name('clients.sales');

    Route::get('/receipts', [SaleController::class, 'receipts'])->name('sales.receipts');
    Route::post('/receipts/{sale}/receipts', [SaleController::class, 'markAsReceived'])->name('sales.markAsReceived');
    Route::post('/receipts/{sale}/notreceipts', [SaleController::class, 'markAsNotReceived'])->name('sales.markAsNotReceived');
});

// Rotas administrativas
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');
});
