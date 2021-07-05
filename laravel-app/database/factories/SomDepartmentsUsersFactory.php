<?php

namespace Database\Factories;

use App\Models\SomDepartmentsUsers;
use Illuminate\Database\Eloquent\Factories\Factory;

class SomDepartmentsUsersFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SomDepartmentsUsers::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'som_departments_id' => $this->faker->randomDigitNotNull,
        'cms_users_id' => $this->faker->randomDigitNotNull
        ];
    }
}
