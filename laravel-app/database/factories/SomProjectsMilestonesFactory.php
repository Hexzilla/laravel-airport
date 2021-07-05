<?php

namespace Database\Factories;

use App\Models\SomProjectsMilestones;
use Illuminate\Database\Eloquent\Factories\Factory;

class SomProjectsMilestonesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SomProjectsMilestones::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'som_projects_phases_id' => $this->faker->randomDigitNotNull,
        'blocking' => $this->faker->randomDigitNotNull,
        'order' => $this->faker->randomDigitNotNull,
        'due_date' => $this->faker->word,
        'name' => $this->faker->word,
        'som_status_id' => $this->faker->randomDigitNotNull,
        'is_hidden' => $this->faker->word
        ];
    }
}
