<?php

namespace Database\Factories;

use App\Models\SomMilestonesFormsTypes;
use Illuminate\Database\Eloquent\Factories\Factory;

class SomMilestonesFormsTypesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SomMilestonesFormsTypes::class;

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
