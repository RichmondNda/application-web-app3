<?php

namespace Database\Factories;

use App\Models\Gestionnaire;
use Illuminate\Database\Eloquent\Factories\Factory;

class GestionnaireFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Gestionnaire::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nom' => $this->faker->name,
            'prenom' => $this->faker->name,
            'numero_tel' => '67 11 64 67',
            'email' => $this->faker->unique()->safeEmail,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role' => 'Simple agent',
            'institue' => 'Mairie'
            // 'institue' => 'Hopitale'
        ];
    }
}
