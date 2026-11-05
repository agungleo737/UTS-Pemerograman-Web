<?php

namespace Database\Factories;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierFactory extends Factory
{
    protected $model = Supplier::class;

    public function definition(): array
    {
        return [
            'kode_supplier' => strtoupper($this->faker->unique()->bothify('SUP-####')),
            'nama_pt'       => 'PT ' . $this->faker->company(),
            'email'         => $this->faker->unique()->companyEmail(),
            'telepon'       => $this->faker->phoneNumber(),
            'alamat'        => $this->faker->address(),
        ];
    }
}