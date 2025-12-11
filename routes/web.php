<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\Home\MyTaskController;

Route::get('/test', [App\Http\Controllers\Controller::class, 'test_test']);
Route::get('/mytask', [MyTaskController::class, 'show'])
->name('mytask.show');

Route::post('/mytask/create', [MyTaskController::class, 'create'])
->name('mytask.create');

Route::post('/mytask/destroy', [MyTaskController::class, 'destroy'])
->name('mytask.destroy');

Route::get('/mytask/{id}/edit', [MyTaskController::class, 'edit'])
->name('mytask.edit');

Route::post('/mytask/{id}/update', [MyTaskController::class, 'update'])
->name('mytask.update');