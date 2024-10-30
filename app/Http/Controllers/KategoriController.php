<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $data['kategori'] = kategori::with('barang')->paginate(4);
        return view('kategori.kategori', $data);
    }

    public function create() {}


    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'nama' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        // Insert data
        $kategori = Kategori::create([
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
        ]);


        return redirect()->route('kategori')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function show(kategori $kategori) {}


    public function edit(kategori $kategori)
    {
        //
    }


    public function update(Request $request, kategori $kategori, $id)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        // Cari kategori berdasarkan ID
        $kategori = Kategori::findOrFail($id);

        // Update data
        $kategori->update([
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('kategori')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(kategori $kategori, $id)
    {
        // Cari kategori berdasarkan ID
        $kategori = Kategori::findOrFail($id);

        // Hapus data
        $kategori->delete();

        return redirect()->route('kategori')->with('success', 'Kategori berhasil dihapus.');
    }
}
