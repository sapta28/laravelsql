<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\Api\PemakaianAirApiController;
use App\Http\Controllers\Api\TagihanApiController;
use App\Http\Controllers\Api\PembayaranApiController;

// Tes koneksi API
Route::get('/tes', function () {
    return response()->json(['message' => 'API route aktif']);
});

// Login (public)
Route::post('login', [AuthController::class, 'login']);

// Logout (optional, bisa juga dihapus kalau tidak butuh)
Route::post('/logout', [AuthController::class, 'logout']);

// Semua route berikut kini tanpa autentikasi
Route::apiResource('users', UserApiController::class);
Route::apiResource('pemakaian_air', PemakaianAirApiController::class);
Route::apiResource('tagihans', TagihanApiController::class);
Route::apiResource('pembayarans', PembayaranApiController::class);
