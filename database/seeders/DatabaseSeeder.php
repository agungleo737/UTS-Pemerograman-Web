<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\KategoriBarang;
use App\Models\Supplier;
use App\Models\Barang;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'manager@gudangsmart.com'],
            [
                'name'     => 'Kurniawan (Manager Gudang)',
                'role'     => 'manager',
                'password' => Hash::make('password123'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'staff@gudangsmart.com'],
            [
                'name'     => 'Andi (Staff Gudang)',
                'role'     => 'staff',
                'password' => Hash::make('password123'),
            ]
        );
        $kategoris = [
            ['kode_kategori' => 'KAT-001', 'nama_kategori' => 'Bahan Baku Logam'],
            ['kode_kategori' => 'KAT-002', 'nama_kategori' => 'Komponen Elektronik'],
            ['kode_kategori' => 'KAT-003', 'nama_kategori' => 'Bahan Kimia & Cat'],
            ['kode_kategori' => 'KAT-004', 'nama_kategori' => 'Kemasan & Karton'],
            ['kode_kategori' => 'KAT-005', 'nama_kategori' => 'Suku Cadang Mesin'],
        ];

        foreach ($kategoris as $kat) {
            KategoriBarang::updateOrCreate(['kode_kategori' => $kat['kode_kategori']], $kat);
        }
        Supplier::factory(10)->create();
        Barang::factory(20)->create();
    }
}