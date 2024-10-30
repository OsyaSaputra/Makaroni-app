<?php

use App\Http\Controllers\ProfileController;
use App\Models\keranjang;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KeranjangController;
use App\Models\barang;
use App\Models\kategori;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('/auth/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin', fn() => view('admin.dashboard'))->name('admin');
Route::get('/user', fn() => view('user.dashboard'))->name('user');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//ini barang
Route::get('/barang', [BarangController::class, 'index'])->name('barang');
// insert data
Route::post('/barang/store', [BarangController::class, 'store'])->name('barang.store');
// form edit
Route::get('/barang/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit');
// update barang
Route::put('/barang/{id}', [BarangController::class, 'update'])->name('barang.update');
// dellete barang
Route::delete('/barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');

//ini kategori
Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');
// insert data
Route::post('/kategori/store', [KategoriController::class, 'store'])->name('kategori.store');
// form edit
Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
// update kategori
Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
// dellete kategori
Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

// ini keranjang
Route::post('/keranjang/store', [KeranjangController::class, 'store'])->name('keranjang.store');