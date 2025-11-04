<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;

Route::get('/', [ProductoController::class, 'index']);
Route::post('/productos', [ProductoController::class, 'postProducto']);
Route::patch('/productos/status/{id}', [ProductoController::class, 'updateStatus']);
Route::get('/productos(update/{id})', [ProductoController::class, 'edit']);
Route::put('/productos/update/{id}', [ProductoController::class, 'updateTodo']);
Route::delete('/productos/delete/{id}', [ProductoController::class, 'deleteTodo']);
