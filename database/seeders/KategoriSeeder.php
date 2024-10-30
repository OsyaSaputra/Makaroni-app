<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama' => 'Original', 'deskripsi' => 'Original',],
            ['nama' => 'Sedikit Pedas', 'deskripsi' => 'Sedikit Pedas',],
            ['nama' => 'Sedang', 'deskripsi' => 'Sedang',],
            ['nama' => 'Sangat Pedas', 'deskripsi' => 'Sangat Pedas',],
        ];

        foreach ($data as $kategori) {
            DB::table('kategori')->insert([
                'nama' => $kategori['nama'],
                'keterangan' => $kategori['deskripsi'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
