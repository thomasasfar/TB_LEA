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

Route::middleware(['guest'])->group(function(){
    Route::get('/', function () {
        return redirect()->route('login');
    });
});

//login
Route::get('/login', [AuthController::class, 'getLogin'])->name('login');
Route::post('/auth/login', [AuthController::class, 'login']);

//register
Route::get('/register', [AuthController::class, 'getRegister']);
Route::post('/auth/register', [AuthController::class, 'store']);

//logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function(){
//barang
Route::get('/katalog', [BarangController::class, 'katalog']);

//profile
Route::get('/profile', [AuthController::class, 'show'])->name('profile');
Route::put('/profile/update', [AuthController::class, 'update'])->name('profile.update');
Route::put('profile/updatephoto', [AuthController::class, 'updatePhoto'])->name('profile.updatePhoto');

//password
Route::get('/password', [AuthController::class, 'change'])->name('password');
Route::put('/password/update', [AuthController::class, 'changePassword'])->name('password.update');

//cetak invoice
Route::get('/print/invoice/{id}', [TransactionController::class, 'cetakInvoice'])->name('cetak.invoice');

//Middleware Admin
Route::middleware(['admin'])->group(function(){
    //barang
    Route::get('/barang', [BarangController::class, 'index']);
    Route::post('/barang/tambah', [BarangController::class, 'store'])->name('barang.store');
    Route::delete('/barang/{barang}/hapus', [BarangController::class, 'destroy']);
    Route::put('/barang/{barang}/update', [BarangController::class, 'update']);
    //transaksi
    Route::get('/transactions', [TransactionController::class, 'index']);
    Route::put('/transactions/{id}/verify', [TransactionController::class, 'verify'])->name('transactions.verify');
    //add transaction booking by admin
    Route::get('/transaction/create', [TransactionController::class, 'create'])->name('transaction.create');
    Route::post('/transaction/storeByAdmin', [TransactionController::class, 'storeByAdmin'])->name('transaction.storeByAdmin');
    //edit transaction booking by admin
    Route::put('/booking/{id}', [TransactionController::class, 'update'])->name('booking.update');
    //hapus transaction
    Route::delete('/transactions/{id}/delete', [TransactionController::class, 'destroy'])->name('transactions.destroy');
});

// Middleware Customer
Route::middleware(['customer'])->group(function(){
//transactions customer
Route::get('/order/add/{id}', [TransactionController::class, 'showItem'])->name('order.showItem');
Route::post('/order/add', [TransactionController::class, 'bookingByUser'])->name('order.add');
// Riwayat page
Route::get('/order', [TransactionController::class, 'show'])->name('order');
//booking page
Route::get('/order/booking', [TransactionController::class, 'showBook'])->name('order.book');
Route::put('/order/booking/{id}/verify', [TransactionController::class, 'verifyBooking'])->name('booking.verify');
//verified page
Route::get('/order/verified', [TransactionController::class, 'showVerified'])->name('order.verified');
//done page
Route::get('/order/done', [TransactionController::class, 'showDone'])->name('order.done');
//ganti tanggal kembali
Route::put('/order/{id}/update', [TransactionController::class, 'updateKembali'])->name('order.update');
});

});
