<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookController;

Route::get('/books', [BookController::class, 'index']);
Route::post('/books/{id}/buy', [BookController::class, 'buy']);
Route::post('/books/{id}/favorite', [BookController::class, 'favorite']);
Route::get('/books/favorites',  [BookController::class, 'favorites']);
