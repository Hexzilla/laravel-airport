<?php

namespace Database\Factories;

use App\Models\SomProjectsAdditionalAirport;
use Illuminate\Database\Eloquent\Factories\Factory;

class SomProjectsAdditionalAirportFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SomProjectsAdditionalAirport::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'som_airport_id' => $this->faker->randomDigitNotNull,
        'som_project_id' => $this->faker->randomDigitNotNull
        ];
    }
}
