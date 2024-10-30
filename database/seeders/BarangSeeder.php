<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Carbon\Carbon;


class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama' => 'Makaroni', 'deskripsi' => 'makaroni', 'Kategori_id' => '1',],
            ['nama' => 'Makaroni', 'deskripsi' => 'makaroni', 'Kategori_id' => '2' ],
            ['nama' => 'Makaroni', 'deskripsi' => 'makaroni', 'Kategori_id' => '3' ],
            ['nama' => 'Makaroni', 'deskripsi' => 'makaroni', 'Kategori_id' => '4' ],
            ['nama' => 'Makaroni Spiral', 'deskripsi' => 'makaroni spiral', 'Kategori_id' => '1' ],
            ['nama' => 'Makaroni Spiral', 'deskripsi' => 'makaroni spiral', 'Kategori_id' => '2' ],
            ['nama' => 'Makaroni Spiral', 'deskripsi' => 'makaroni spiral', 'Kategori_id' => '3' ],
            ['nama' => 'Makaroni Spiral', 'deskripsi' => 'makaroni spiral', 'Kategori_id' => '4' ],
            ['nama' => 'Makaroni Keong', 'deskripsi' => 'makaroni keong', 'Kategori_id' => '1' ],
            ['nama' => 'Makaroni Keong', 'deskripsi' => 'makaroni keong', 'Kategori_id' => '2' ],
            ['nama' => 'Makaroni Keong', 'deskripsi' => 'makaroni keong', 'Kategori_id' => '3' ],
            ['nama' => 'Makaroni Keong', 'deskripsi' => 'makaroni keong', 'Kategori_id' => '4' ],
            ['nama' => 'Basreng', 'deskripsi' => 'basreng', 'Kategori_id' => '1' ],
            ['nama' => 'Basreng', 'deskripsi' => 'basreng', 'Kategori_id' => '2' ],
            ['nama' => 'Basreng', 'deskripsi' => 'basreng', 'Kategori_id' => '3' ],
            ['nama' => 'Basreng', 'deskripsi' => 'basreng', 'Kategori_id' => '4' ],
            ['nama' => 'Kerupuk', 'deskripsi' => 'kerupuk', 'Kategori_id' => '1' ],
            ['nama' => 'Kerupuk', 'deskripsi' => 'kerupuk', 'Kategori_id' => '2' ],
            ['nama' => 'Kerupuk', 'deskripsi' => 'kerupuk', 'Kategori_id' => '3' ],
            ['nama' => 'Kerupuk', 'deskripsi' => 'kerupuk', 'Kategori_id' => '4' ],
        ];

        foreach ($data as $barang) {
            DB::table('barang')->insert([
                'nama' => $barang['nama'],
                'deskripsi' => $barang['deskripsi'],
                'Kategori_id' => $barang['Kategori_id'],
                'harga' => Arr::random([6000]),
                'stok' => Arr::random([10, 12, 14, 16]),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
