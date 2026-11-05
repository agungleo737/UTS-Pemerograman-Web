<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriBarang extends Model
{
    use HasFactory;

    // WAJIB ADA agar Laravel tidak mencari tabel 'kategori_barangs' (pakai s)
    protected $table = 'kategori_barang';

    protected $fillable = [
        'kode_kategori',
        'nama_kategori',
    ];

    public function barang()
    {
        return $this->hasMany(Barang::class, 'kategori_id');
    }
}