<?php

namespace App\Http\Controllers;

use App\Models\keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_barang' => 'required|exists:barang,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        // Ambil data barang
        $barang = \App\Models\Barang::findOrFail($request->id_barang);

        // Hitung total harga
        $total = $barang->harga * $request->jumlah;

        // Simpan data ke tabel keranjang
        Keranjang::create([
            'id_user' => Auth::id(), // Mengambil ID pengguna yang sedang login
            'id_barang' => $barang->id,
            'harga' => $barang->harga,
            'jumlah' => $request->jumlah,
            'total' => $total,
        ]);

        return redirect()->route('barang')->with('success', 'Barang berhasil ditambahkan ke keranjang.');
    }

    /**
     * Display the specified resource.
     */
    public function show(keranjang $keranjang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(keranjang $keranjang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, keranjang $keranjang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(keranjang $keranjang)
    {
        //
    }
}
