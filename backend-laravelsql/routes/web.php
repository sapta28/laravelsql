<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PemakaianAirController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\Auth\LoginController; // Pastikan ini mengarah ke LoginController yang benar

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Rute untuk Login dan Logout
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Rute Dashboard yang Terproteksi (Hanya bisa diakses setelah login)
Route::get('dashboard', function() {
    return view('user.dashboard'); // Mengarah ke resources/views/dashboard.blade.php
})->middleware('auth')->name('dashboard');

// Rute Resource (CRUD)
Route::resource('users', UserController::class);
Route::resource('pemakaian_air', PemakaianAirController::class);
Route::resource('tagihans', TagihanController::class);
Route::resource('pembayarans', PembayaranController::class);

// Rute Khusus untuk Pembayaran
Route::post('/pembayarans/{id}/konfirmasi', [PembayaranController::class, 'konfirmasi'])->name('pembayarans.konfirmasi');
Route::get('/pembayarans/{id}/cetak', [PembayaranController::class, 'cetak'])->name('pembayarans.cetak');
Route::get('/pembayarans/{id}/cetak-pdf', [PembayaranController::class, 'cetakPdf'])->name('pembayarans.cetakPdf');

// Jika Anda memiliki dashboard khusus untuk user yang dihandle oleh UserController,
// Anda mungkin ingin memberinya nama rute yang berbeda atau path yang lebih spesifik
// agar tidak bentrok dengan '/dashboard' yang baru ditambahkan.
// Contoh: Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
// Untuk saat ini, rute duplikat yang tidak memiliki nama atau middleware telah dihapus
// untuk menghindari ambiguitas.