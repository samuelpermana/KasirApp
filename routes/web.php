<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;

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
Auth::routes();
Route::group(['middleware' => 'auth'], function(){
    Route::get('/', function () {
        return view('index');
    });
    
    
    Route::get('/kasir', function () {
        return view('kasir');
    });
    Route::get('/riwayat-transaksi', function () {
        return view('transaksi');
    });
    Route::get('/kategori', function () {
        return view('kategori');
    });
    Route::get('/produk', function () {
        return view('produk');
    });
    
    Route::get('/kasir', [KasirController::class, 'showKasir'])->name('show-kasir');
    Route::post('/add-to-cart', [KasirController::class, 'addToCart'])->name('add-to-cart');
    Route::post('/complete-transaction', [KasirController::class, 'transaction'])->name('complete-transaction');
    
    
    Route::get('/riwayat-transaksi', [TransaksiController::class, 'showTrans'])->name('riwayat-transaksi');

    Route::get('/kategori/search', [KategoriController::class, 'search'])->name('kategori.search');
    Route::get('/kategori', [KategoriController::class, 'showCat'])->name('kategori.show');
    Route::post('/kategori/add', [KategoriController::class, 'addKat'])->name('kategori.add');
    Route::put('/kategori/update', [KategoriController::class, 'updateKat'])->name('kategori.update');
    Route::delete('/kategori/delete', [KategoriController::class, 'deleteKat'])->name('kategori.delete');
    
    
    Route::get('/produk', [ProdukController::class, 'showCat'])->name('produk.show');
    Route::post('/produk/add', [ProdukController::class, 'addKat'])->name('produk.add');
    Route::put('/produk/update', [ProdukController::class, 'updateKat'])->name('produk.update');
    Route::delete('/produk/delete', [ProdukController::class, 'deleteKat'])->name('produk.delete');
    
    Route::get('/produk', [ProdukController::class, 'showProduk'])->name('produk.show');
    Route::post('/produk/add', [ProdukController::class, 'addProduk'])->name('produk.add');
    Route::put('/produk/update', [ProdukController::class, 'updateProduk'])->name('produk.update');
    Route::delete('/produk/delete', [ProdukController::class, 'deleteProduk'])->name('produk.delete');
    
    
    
});
    Auth::routes();
    
    