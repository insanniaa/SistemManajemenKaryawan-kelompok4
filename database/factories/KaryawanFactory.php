<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Karyawan>
 */
class KaryawanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'jabatan' => $this->faker->jobTitle,
            'tempat_lahir' => $this->faker->city,
            'tanggal_lahir' => $this->faker->date,
            'alamat' => $this->faker->address,
            'tanggal_bergabung' => $this->faker->date,
            'nomor_rekening' => $this->faker->bankAccountNumber,
            'email' => $this->faker->unique()->safeEmail,
            'nomor_handphone' => $this->faker->phoneNumber,
            'slug' => $this->faker->slug()
        ];
    }
}
