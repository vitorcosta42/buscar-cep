<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\SearchZipcodeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/buscar-cep/{cep}', [SearchZipcodeController::class, 'searchZipcode']);

Route::apiResource('endereco', AddressController::class);
