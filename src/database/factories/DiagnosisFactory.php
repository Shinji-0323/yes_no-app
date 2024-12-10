<?php

namespace Database\Factories;

use App\Models\Diagnosis;
use Illuminate\Database\Eloquent\Factories\Factory;

class DiagnosisFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'gender' => $this->faker->randomElement(['male', 'female']),
            'age' => $this->faker->randomElement(['20s', '30s', '40s']),
            'result' => $this->faker->randomElement(['a1', 'a2', 'a3', 'a4']),
        ];
    }
}
