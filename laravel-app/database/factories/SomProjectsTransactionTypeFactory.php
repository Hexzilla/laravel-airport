<?php

namespace Database\Factories;

use App\Models\SomProjectsTransactionType;
use Illuminate\Database\Eloquent\Factories\Factory;

class SomProjectsTransactionTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SomProjectsTransactionType::class;

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
