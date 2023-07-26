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
<<<<<<< HEAD
 

<<<<<<< HEAD
Route::get('/login',[AuthController::class,'login']);
Route::get('/register',[AuthController::class,'register']);
Route::get('/profile',[AuthController::class,'profile']);
=======
>>>>>>> 907f72522e8016078494a4d06c4aa650b2f6b944
=======
>>>>>>> e9a3b2efd41eded5103789f94393350361b0e4b6

Route::get('/user/profile', [App\Http\Controllers\AuthController::class, 'profile']); 