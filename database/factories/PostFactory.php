<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'titulo' => $this->faker->sentence(5),
            'descripcion'=> $this->faker->sentence(20),
            'imagenUrl'=>$this->faker->uuid() . '.jpg',
            'user_id'=> $this->faker->randomElement([7,8,9])
        ];
    }
}
