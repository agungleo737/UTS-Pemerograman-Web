<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBarangRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'kode_barang'  => 'required|string|max:10|unique:barang,kode_barang',
            'nama_barang'  => 'required|string|min:3',
            'kategori_id'  => 'required|exists:kategori_barang,id',
            'supplier_id'  => 'required|exists:suppliers,id',
            'stok'         => 'required|numeric|min:0',
            'harga_satuan' => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'kode_barang.required'  => 'Kode barang wajib diisi.',
            'kode_barang.max'       => 'Kode barang maksimal 10 karakter.',
            'kode_barang.unique'    => 'Kode barang sudah digunakan.',
            'nama_barang.required'  => 'Nama barang wajib diisi.',
            'nama_barang.min'       => 'Nama barang minimal 3 karakter.',
            'stok.required'         => 'Stok wajib diisi.',
            'stok.numeric'          => 'Stok harus berupa angka.',
            'stok.min'              => 'Stok tidak boleh negatif.',
            'harga_satuan.required' => 'Harga satuan wajib diisi.',
            'harga_satuan.numeric'  => 'Harga satuan harus berupa angka.',
        ];
    }
}