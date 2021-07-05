<?php

namespace Database\Factories;

use App\Models\SomForms;
use Illuminate\Database\Eloquent\Factories\Factory;

class SomFormsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SomForms::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
        'active' => $this->faker->randomDigitNotNull,
        'som_phases_milestones_id' => $this->faker->randomDigitNotNull,
        'order_form' => $this->faker->randomDigitNotNull,
        'som_milestones_forms_types_id' => $this->faker->randomDigitNotNull,
        'som_status_id' => $this->faker->randomDigitNotNull,
        'is_inactive' => $this->faker->word
        ];
    }
}
