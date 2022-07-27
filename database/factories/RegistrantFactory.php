<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Registrant>
 */
class RegistrantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'city' => $this->faker->randomElement(['Semarang', 'Jepara', 'Demak', 'Kudus']),
            'program' => $this->faker->randomElement(['Les Privat Offliine', 'Les Privat Offline', 'Les Kilat Offline', 'Les Kilat Online']),
            'message' => $this->faker->sentence(5, true),
            'phone' => '08' . mt_rand(1, 9) . mt_rand(100000000, 999999999),
        ];
    }
}
