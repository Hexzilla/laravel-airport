<?php

namespace Database\Factories;

use App\Models\SomNews;
use Illuminate\Database\Eloquent\Factories\Factory;

class SomNewsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SomNews::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word,
        'news_description' => $this->faker->word,
        'date_from' => $this->faker->word,
        'date_until' => $this->faker->word
        ];
    }
}
