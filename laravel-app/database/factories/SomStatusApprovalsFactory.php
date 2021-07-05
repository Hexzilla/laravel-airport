<?php

namespace Database\Factories;

use App\Models\SomStatusApprovals;
use Illuminate\Database\Eloquent\Factories\Factory;

class SomStatusApprovalsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SomStatusApprovals::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'som_status_id' => $this->faker->randomDigitNotNull,
        'som_approvals_responsible_id' => $this->faker->randomDigitNotNull,
        'status_order' => $this->faker->randomDigitNotNull
        ];
    }
}
