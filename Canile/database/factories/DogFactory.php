<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Dog;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dog>
 */
class DogFactory extends Factory
{
    
    protected $model=Dog::class;
    public function definition()
    {
        return [
            'nome'=> $this->faker->randomElement(['Asia', 'Bea', 'Billy', 'Birba', 'Birillo', 'Bobby', 'Black', 'Buck', 
            'Fiamma',  'Fido', 'Fuffi', 'Milo', 'Mya', 'Nero', 'Pluto', 'Peggy', 'Pongo', 'Regina', 'Rex', 'Rocky', 'Snoopy']),
            'razza'=> $this->faker->randomElement(['Meticcio', 'Labrador']),
            'colore'=> $this->faker->randomElement(['Marrone', 'Rosso', 'Oro', 'Crema', 'Fulvo','Nero','Grigio','Bianco','Bianco-nero','Bianco-marrone']),
            'lunghezza pelo'=>$this->faker->randomElement(['Corto', 'Lungo']),
            'taglia'=>$this->faker->randomElement(['Piccola', 'Media','Granda']),
            'sesso'=> $this->faker->randomElement(['Maschio', 'Femmina']),
            'età'=>$this->faker->numberBetween(0, 20),

        ];
    }
}
