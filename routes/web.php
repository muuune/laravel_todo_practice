<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', [App\Http\Controllers\Controller::class, 'test_test']);
Route::get('/mytask', [App\Http\Controllers\Home\MyTaskController::class, 'show'])
->name('mytask.show');

Route::post('/mytask/create', [App\Http\Controllers\Home\MyTaskController::class, 'create'])
->name('mytask.create');

Route::post('/mytask/destroy', [App\Http\Controllers\Home\MyTaskController::class, 'destroy'])
->name('mytask.destroy');