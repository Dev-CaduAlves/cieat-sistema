<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Armamento>
 */
class ArmamentoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    return [
        'tipo_armamento' => fake()->randomElement(['PISTOLA', 'FUZIL']),
        'fabricante' => fake()->randomElement(['TAURUS', 'IMBEL']),
        'modelo' => fake()->bothify('MOD-##??'),
        'calibre' => fake()->randomElement(['9mm', '5.56', '7.62']),
        'numero_serie' => fake()->unique()->bothify('???#####'), // Gera algo como ABC12345
        'situacao' => 'DISPONIVEL',
        'observacoes' => 'Carga inicial do sistema',
    ];
}
}
