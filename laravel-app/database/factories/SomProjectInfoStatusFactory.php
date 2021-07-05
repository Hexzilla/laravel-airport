<?php

namespace Database\Factories;

use App\Models\SomProjectInfoStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class SomProjectInfoStatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SomProjectInfoStatus::class;

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
