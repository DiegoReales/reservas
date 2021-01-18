<?php

namespace Database\Factories;

use App\Models\Lugar;
use Illuminate\Database\Eloquent\Factories\Factory;

class LugarFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Lugar::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->city,
            'direccion' => $this->faker->address,
            'telefono' => $this->faker->phoneNumber,
        ];
    }
}
