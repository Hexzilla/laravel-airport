<?php

namespace Database\Factories;

use App\Models\SomPhases;
use Illuminate\Database\Eloquent\Factories\Factory;

class SomPhasesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SomPhases::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
        'hex_color' => $this->faker->word,
        'is_visible' => $this->faker->word
        ];
    }
}
