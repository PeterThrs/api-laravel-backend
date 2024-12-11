<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\usuarioController;
use App\Http\Controllers\plantaController;

Route::get('/users', [usuarioController::class, 'index']); 

Route::get('/users/{id}', [usuarioController::class, 'show']);

Route::post('/users', [usuarioController::class, 'store']);

Route::put('/users/{id}', [usuarioController::class, 'update']);

Route::patch('/users/{id}', [usuarioController::class, 'updatePartial']);

Route::delete('/users/{id}', [usuarioController::class, 'destroy']);





Route::get('/plants', [plantaController::class, 'index']); 

Route::get('/plants/{id}', [plantaController::class, 'show']);

Route::post('/plants', [plantaController::class, 'store']);

Route::put('/plants/{id}', [plantaController::class, 'update']);

Route::patch('/plants/{id}', [plantaController::class, 'updatePartial']);

Route::delete('/plants/{id}', [plantaController::class, 'destroy']);

