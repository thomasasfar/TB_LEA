<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\TransactionController;

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
Route::get('/login', [AuthController::class, 'getLogin'])->name('login');
Route::post('/auth/login', [AuthController::class, 'login']);

//register
Route::get('/register', [AuthController::class, 'getRegister']);
Route::post('/auth/register', [AuthController::class, 'store']);

//logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//barang
Route::get('/katalog', [BarangController::class, 'katalog']);


//profile
Route::get('/profile', [AuthController::class, 'show'])->name('profile');
Route::put('/profile/update', [AuthController::class, 'update'])->name('profile.update');
Route::put('profile/updatephoto', [AuthController::class, 'updatePhoto'])->name('profile.updatePhoto');

//password
Route::get('/password', [AuthController::class, 'change'])->name('password');
Route::put('/password/update', [AuthController::class, 'changePassword'])->name('password.update');

//Middleware Admin
Route::middleware(['admin'])->group(function(){
    //barang
    Route::get('/barang', [BarangController::class, 'index']);
    Route::post('/barang/tambah', [BarangController::class, 'store'])->name('barang.store');
    Route::delete('/barang/{barang}/hapus', [BarangController::class, 'destroy']);
    Route::put('/barang/{barang}/update', [BarangController::class, 'update']);
    //transaksi
    Route::get('/transactions', [TransactionController::class, 'index']);
    Route::put('/transactions/{id_transaksi}/verify', [TransactionController::class, 'verify'])->name('transactions.verify');
    //add transaction booking by admin
    Route::get('/transaction/create', [TransactionController::class, 'create'])->name('transaction.create');
    Route::post('/transaction/storeByAdmin', [TransactionController::class, 'storeByAdmin'])->name('transaction.storeByAdmin');
});

//transactions customer
Route::get('/order/add/{id}', [TransactionController::class, 'showItem'])->name('order.showItem');
