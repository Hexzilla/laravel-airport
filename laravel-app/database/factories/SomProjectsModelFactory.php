<?php

namespace Database\Factories;

use App\Models\SomProjectsModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class SomProjectsModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SomProjectsModel::class;

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
