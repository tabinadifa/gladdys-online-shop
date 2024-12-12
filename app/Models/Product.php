<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'nama_produk',
        'kategori_produk',
        'berat_produk',
        'deskripsi_produk',
        'harga_produk',
        'gambar_produk',
    ];

    protected $primaryKey = 'id_produk';

    public $incrementing = true;

    protected $keyType = 'int';
}
