<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBarangRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'kode_barang' => [
                'required', 'string', 'max:10',
                Rule::unique('barang', 'kode_barang')->ignore($this->route('barang')),
            ],
            'nama_barang'  => 'required|string|min:3',
            'kategori_id'  => 'required|exists:kategori_barang,id',
            'supplier_id'  => 'required|exists:suppliers,id',
            'stok'         => 'required|numeric|min:0',
            'harga_satuan' => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return (new StoreBarangRequest())->messages();
    }
}