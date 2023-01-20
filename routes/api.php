<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClientesController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/get_all_clientes', [ClientesController::class, 'get_all_clientes']);

Route::post('/add_cliente', [ClientesController::class, 'add_cliente']);
