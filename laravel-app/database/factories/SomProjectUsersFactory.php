<?php

namespace Database\Factories;

use App\Models\SomProjectUsers;
use Illuminate\Database\Eloquent\Factories\Factory;

class SomProjectUsersFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SomProjectUsers::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'som_projects_id' => $this->faker->randomDigitNotNull,
        'cms_users_id' => $this->faker->randomDigitNotNull,
        'cms_privileges_id' => $this->faker->randomDigitNotNull
        ];
    }
}
