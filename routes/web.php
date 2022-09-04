<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::post('/books', [App\Http\Controllers\BookController::class, 'store']);

Route::patch('/books/{book}', [App\Http\Controllers\BookController::class, 'update']);

Route::delete('/books/{book}', [App\Http\Controllers\BookController::class, 'delete']);
