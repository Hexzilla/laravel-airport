<?php

namespace Database\Factories;

use App\Models\SomProjectsPhases;
use Illuminate\Database\Eloquent\Factories\Factory;

class SomProjectsPhasesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SomProjectsPhases::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'som_projects_id' => $this->faker->randomDigitNotNull,
        'som_phases_id' => $this->faker->randomDigitNotNull,
        'order' => $this->faker->randomDigitNotNull,
        'som_status_id' => $this->faker->randomDigitNotNull
        ];
    }
}
