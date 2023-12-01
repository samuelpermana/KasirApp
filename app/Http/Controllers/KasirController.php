<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class KasirController extends Controller
{
    public function showKasir()
    {
        $datas = DB::select('SELECT Produk.*, Kategori.nama AS nama_kategori
        FROM Produk
        JOIN Kategori ON Produk.id_kategori = Kategori.id;
        ');

        $carts = DB::select('SELECT Keranjang.*, Produk.nama_produk AS nama_produk, Produk.harga AS harga_produk
        FROM Keranjang
        JOIN Produk ON Keranjang.id_produk = Produk.id
        WHERE Keranjang.is_active = 1;
        ');
        $totalHarga = 0; 
    foreach ($carts as $cart) {
        $totalHarga += $cart->harga_produk * $cart->jumlah;
    }
    return view('kasir', compact('datas', 'carts', 'totalHarga'));
    }
    
    public function addToCart(Request $request)
    {

        $productId = $request->input('id_produk');
        $product = DB::select('select * from produk where id = ?', [$productId]);
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }
        $productOnCart = DB::select('SELECT * FROM keranjang WHERE id_produk = ? AND is_active = 1', [$productId]);
        if ($productOnCart) {

            $productData = $productOnCart[0];
            $newQuantity = $productData->jumlah + $request->input('jumlah'); 
            DB::update('UPDATE keranjang SET jumlah = ? WHERE id_produk = ? AND is_active = 1', [$newQuantity, $productId]);
        } else {
            DB::insert('insert into keranjang (id_produk, jumlah) values (?, ?)', [$productId, $request->input('jumlah')]);
        }
        return redirect()->back()->with('success', 'Product added to cart successfully');
    }

    public function transaction(Request $request)
{
    $carts = DB::select('SELECT Keranjang.*, Produk.nama_produk AS nama_produk, Produk.harga AS harga_produk
    FROM Keranjang
    JOIN Produk ON Keranjang.id_produk = Produk.id;
    ');
    $totalHarga = 0; 


    foreach ($carts as $cart) {
        $totalHarga += $cart->harga_produk * $cart->jumlah;
    }

        $jumlahBayar = max(floatval($request->input('jumlah_bayar')), $totalHarga);

    DB::insert('INSERT INTO transaksi (jumlah_biaya_total, jumlah_bayar) VALUES (?, ?)', [$totalHarga, $jumlahBayar]);

    $idTransaksi = DB::getPdo()->lastInsertId();
    DB::update('UPDATE keranjang SET is_active = 0, id_transaksi = ? WHERE is_active = 1', [$idTransaksi]);

    return redirect()->back()->with('success', 'Transaction success');
}



   

}
