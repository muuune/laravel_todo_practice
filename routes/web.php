<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Home\MyTaskController;

Route::get('/', function () {
    return auth()->check() ? redirect()->route('mytask.show') : redirect()->route('login');
});

// 認証関連のルート（未ログインでもアクセス可能）
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// タスク関連のルート（ログイン必須）
Route::middleware('auth')->group(function () {
    Route::get('/mytask', [MyTaskController::class, 'show'])->name('mytask.show');
    Route::post('/mytask/create', [MyTaskController::class, 'create'])->name('mytask.create');
    Route::post('/mytask/destroy', [MyTaskController::class, 'destroy'])->name('mytask.destroy');
    Route::get('/mytask/{task}/edit', [MyTaskController::class, 'edit'])->name('mytask.edit');
    Route::post('/mytask/{task}/update', [MyTaskController::class, 'update'])->name('mytask.update');
    Route::post('/mytask/{task}/status', [MyTaskController::class, 'updateStatus'])->name('mytask.updateStatus');
});