<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Vaccination;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Treatments>
 */
class VaccinationFactory extends Factory
{
    protected $model=Vaccination::class;

    public function definition()
    {
        return [
            'malattia'=> $this->faker->randomElement(['Anaplasmosi', 'Borreliosi dei cani', 'Ehrlichiosi', 'Didofilariosi', 'Rabbia','Leishmaniosi','Nessuna']),
        ];
    }
}
