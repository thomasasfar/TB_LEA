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
Route::get('/barang', [App\Http\Controllers\BarangController::class, 'index']);
Route::post('/barang/tambah', [App\Http\Controllers\BarangController::class, 'store']);
Route::delete('/barang/{barang}/hapus', [App\Http\Controllers\BarangController::class, 'destroy']);
Route::put('/barang/{barang}/update', [App\Http\Controllers\BarangController::class, 'update']);
 


