<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blanko>
 */
class BlankoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->name(),
            'provinsi' => $this->faker->name(),
            'kabupaten' => $this->faker->name(),
            'kecamatan' => $this->faker->name(),
            'desa' => $this->faker->name(),
            'detail' => $this->faker->name(),
            'tipe' => 'VIP',
            'status' => 'aktif',
            'maps' => "https://maps.app.goo.gl/EMuDGMBg9LDc22G56",
            'foto' => "https://via.placeholder.com/300x300",
        ];
    }
}
