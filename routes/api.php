<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\usuarioController;

Route::get('/users', [usuarioController::class, 'index']); 

Route::get('/users/{id}', [usuarioController::class, 'show']);

Route::post('/users', [usuarioController::class, 'store']);

Route::put('/users/{id}', [usuarioController::class, 'update']);

Route::patch('/users/{id}', [usuarioController::class, 'updatePartial']);

Route::delete('/users/{id}', [usuarioController::class, 'destroy']);

