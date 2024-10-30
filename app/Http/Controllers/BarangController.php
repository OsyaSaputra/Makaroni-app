<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;



class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::with('kategori')->paginate(4);    
        $kategori = Kategori::all();
        return view('barang.barang', compact(['barang', 'kategori']));
    }

    public function create() {}

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori_id' => 'required|exists:kategori,id',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Simpan gambar jika ada
        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('images', 'public');
        }

        Barang::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'kategori_id' => $request->kategori_id, // Foreign key
            'harga' => $request->harga,
            'stok' => $request->stok,
            'gambar' => $gambarPath, // Path p
        ]);
        // dd($gambarPath);


        return redirect()->route('barang')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        $kategori = Kategori::all(); // mengisi dropdown edit
        return view('barang.edit', compact('barang', 'kategori'));
    }

    public function show(kategori $kategori) {}

    /**
     * Show the form for editing the specified resource.
     */

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori_id' => 'required|exists:kategori,id',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $barang = Barang::findOrFail($id);

        // Cek jika file baru
        if ($request->hasFile('gambar')) {
            // Hapus yg lama jika ada
            if ($barang->gambar) {
                Storage::disk('public')->delete($barang->gambar);
            }

            // Simpan gambar baru
            $gambarPath = $request->file('gambar')->store('images', 'public');
        } else {
            // Jika tidak baru, pakai gambar lama
            $gambarPath = $barang->gambar;
        }

        // Update gambar (jika ada)
        $barang->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'kategori_id' => $request->kategori_id, // foreign key
            'gambar' => $gambarPath, // Gambar baru atau lama
        ]);

        return redirect()->route('barang')->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Barang::destroy($id);
        return redirect()->route('barang')->with('success', 'Barang berhasil dihapus.');
    }
}
