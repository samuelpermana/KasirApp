<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    public function showProduk()
    {
        $datas = DB::select('SELECT Produk.*, Kategori.nama AS nama_kategori
        FROM Produk
        JOIN Kategori ON Produk.id_kategori = Kategori.id;
        ');
        $kategoriOptions = DB::select('SELECT * FROM kategori');

        return view('produk', compact('datas', 'kategoriOptions'));
    }

    public function addProduk(Request $request)
    {
        // Validasi data input jika diperlukan
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'id_kategori' => 'required|integer',
        ]);

        // Insert data ke tabel produk
        DB::insert('INSERT INTO produk (nama_produk, harga, id_kategori) VALUES (?, ?, ?)', [
            $request->input('nama_produk'),
            $request->input('harga'),
            $request->input('id_kategori'),
        ]);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan');
    }

    public function updateProduk(Request $request)
    {
        // Validasi data input jika diperlukan
        $request->validate([
            'id' => 'required|integer',
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'id_kategori' => 'required|integer',
        ]);

        // Update data produk berdasarkan ID
        DB::update('UPDATE produk SET nama_produk = ?, harga = ?, id_kategori = ? WHERE id = ?', [
            $request->input('nama_produk'),
            $request->input('harga'),
            $request->input('id_kategori'),
            $request->input('id'),
        ]);

        return redirect()->back()->with('success', 'Produk berhasil diperbarui');
    }

    public function deleteProduk(Request $request)
    {
        // Validasi data input jika diperlukan
        $request->validate([
            'id' => 'required|integer',
        ]);

        // Hapus data produk berdasarkan ID
        DB::delete('DELETE FROM produk WHERE id = ?', [$request->input('id')]);

        return redirect()->back()->with('success', 'Produk berhasil dihapus');
    }

    
}
