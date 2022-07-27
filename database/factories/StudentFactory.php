<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
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
            'study_level' => $this->faker->randomElement(['SMA', 'SMP', 'SD', 'OSN', 'Tes Kedinasan']),
            'lesson' => $this->faker->randomElement(['Matematika', 'Fisika', 'Biologi', 'Kimia', 'Bahasa Inggris', 'Bahasa Indonesia', 'Geografi', 'Ekonomi', 'Sejarah', 'Sosiologi']),
            'phone' => '08' . mt_rand(1, 9) . mt_rand(100000000, 999999999),
        ];
    }
}
