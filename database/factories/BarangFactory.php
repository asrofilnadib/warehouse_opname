<?php

namespace Database\Factories;

use App\Models\Barang;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Barang>
 */
class BarangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_barang' => $this->faker->randomElement([
              'Ayam',
              'Ikan',
              'Teh Lemon',
              'Kopi',
            ]),
            'jenis_barang' => $this->faker->randomElement([
              'Makanan',
              'Minuman',
            ]),
            'id_satuan' => $this->faker->numberBetween(1, 8),
            'user_id' => $this->faker->numberBetween(1, 3),
            'stock' => $this->faker->numberBetween(0, 175),
        ];
    }
}
