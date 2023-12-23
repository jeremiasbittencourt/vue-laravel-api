<?php

use App\Http\Controllers\Api\EstudanteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('estudantes', [EstudanteController::class, 'index']);
Route::post('estudantes', [EstudanteController::class, 'store']);
Route::get('estudantes/{id}', [EstudanteController::class, 'show']);
Route::get('estudantes/{id}/edit', [EstudanteController::class, 'edit']);
Route::put('estudantes/{id}/edit', [EstudanteController::class, 'update']);
Route::DELETE('estudantes/{id}/delete', [EstudanteController::class, 'destroy']);