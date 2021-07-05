<?php

namespace Database\Factories;

use App\Models\SomProjectsPriority;
use Illuminate\Database\Eloquent\Factories\Factory;

class SomProjectsPriorityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SomProjectsPriority::class;

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
