<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function showTrans()
    {
        $datas = DB::select('SELECT * FROM transaksi');

        // Mengambil detail transaksi dari tabel Keranjang
        $details = [];
        foreach ($datas as $transaksi) {
            $detail = DB::select('
                SELECT Keranjang.*, Produk.nama_produk AS nama_produk, Produk.harga AS harga_produk
                FROM Keranjang
                JOIN Produk ON Keranjang.id_produk = Produk.id
                WHERE Keranjang.id_transaksi = ?;
            ', [$transaksi->id]);

            $details[$transaksi->id] = $detail;
        }

        return view('transaksi', compact('datas', 'details'));
    }
}
