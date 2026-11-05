<?php

namespace Database\Factories;

use App\Models\Barang;
use App\Models\KategoriBarang;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class BarangFactory extends Factory
{
    protected $model = Barang::class;

    public function definition(): array
    {
        return [
            'kode_barang'  => strtoupper($this->faker->unique()->bothify('BRG-####')),
            'kategori_id'  => KategoriBarang::inRandomOrder()->value('id'),
            'supplier_id'  => Supplier::inRandomOrder()->value('id'),
            'nama_barang'  => 'Komponen ' . ucfirst($this->faker->words(2, true)),
            'stok'         => $this->faker->numberBetween(10, 200),
            'harga_satuan' => $this->faker->numberBetween(15000, 500000),
        ];
    }
}