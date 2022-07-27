<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teacher>
 */
class TeacherFactory extends Factory
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
            'phone' => '08' . mt_rand(1, 9) . mt_rand(100000000, 999999999),
            'student_totals' => mt_rand(10, 99),
            'status' => mt_rand(0, 2),
        ];
    }
}
