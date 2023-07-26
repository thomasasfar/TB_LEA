<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

//login
Route::get('/login', [App\Http\Controllers\AuthController::class, 'getLogin'])->name('login');
Route::post('/auth/login', [App\Http\Controllers\AuthController::class, 'login']);

//register
Route::get('/register', [App\Http\Controllers\AuthController::class, 'getRegister']);
Route::post('/auth/register', [App\Http\Controllers\AuthController::class, 'store']);

//barang
Route::get('/barang', [App\Http\Controllers\BarangController::class, 'index']);
Route::post('/barang/tambah', [App\Http\Controllers\BarangController::class, 'store']);
Route::delete('/barang/{barang}/hapus', [App\Http\Controllers\BarangController::class, 'destroy']);
Route::put('/barang/{barang}/update', [App\Http\Controllers\BarangController::class, 'update']);