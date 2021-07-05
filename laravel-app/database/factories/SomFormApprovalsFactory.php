<?php

namespace Database\Factories;

use App\Models\SomFormApprovals;
use Illuminate\Database\Eloquent\Factories\Factory;

class SomFormApprovalsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SomFormApprovals::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
        'som_forms_id' => $this->faker->randomDigitNotNull,
        'order_approval' => $this->faker->randomDigitNotNull
        ];
    }
}
