<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TransaksiBarang>
 */
class TransaksiBarangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_barang' => $this->faker->numberBetween(1, 4),
            'jenis' => $this->faker->randomElement([
              'Masuk',
              'Keluar',
            ]),
            'qty' => $this->faker->numberBetween(1, 50),
            'user_id' => $this->faker->numberBetween(1, 3),
            'tanggal_transaksi' => $this->faker->dateTimeBetween('-3 week', 'now')
        ];
    }
}
