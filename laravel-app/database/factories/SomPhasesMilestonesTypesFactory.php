<?php

namespace Database\Factories;

use App\Models\SomPhasesMilestonesTypes;
use Illuminate\Database\Eloquent\Factories\Factory;

class SomPhasesMilestonesTypesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SomPhasesMilestonesTypes::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word
        ];
    }
}
