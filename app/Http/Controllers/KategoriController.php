<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    public function showCat()
    {
        $datas = DB::select('SELECT * FROM kategori');
    
        return view('kategori', compact('datas'));
    }

    public function addKat(Request $request)
    {
        // Validasi data input jika diperlukan
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        // Insert data ke tabel kategori
        DB::insert('INSERT INTO kategori (nama) VALUES (?)', [$request->input('nama')]);

        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan');
    }

    public function updateKat(Request $request)
    {
        // Validasi data input jika diperlukan
        $request->validate([
            'id' => 'required|integer',
            'nama' => 'required|string|max:255',
        ]);

        // Update data kategori berdasarkan ID
        DB::update('UPDATE kategori SET nama = ? WHERE id = ?', [$request->input('nama'), $request->input('id')]);

        return redirect()->back()->with('success', 'Kategori berhasil diperbarui');
    }

    public function deleteKat(Request $request)
    {
        // Validasi data input jika diperlukan
        $request->validate([
            'id' => 'required|integer',
        ]);

        // Hapus data kategori berdasarkan ID
        DB::delete('DELETE FROM kategori WHERE id = ?', [$request->input('id')]);

        return redirect()->back()->with('success', 'Kategori berhasil dihapus');
    }

    public function search(Request $request)
{
    $search = $request->input('search');
    $datas = DB::select("SELECT * FROM kategori WHERE nama LIKE ?", ["%$search%"]);

    return view('kategori', compact('datas'));
}

}
