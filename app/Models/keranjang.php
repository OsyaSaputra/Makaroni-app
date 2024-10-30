<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class keranjang extends Model
{
    use HasFactory;
    protected $table = 'keranjang';
    protected $fillable = ['id_user', 'id_barang', 'harga', 'jumlah', 'total'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }



    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }
}
