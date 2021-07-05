<?php

namespace Database\Factories;

use App\Models\SomStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class SomStatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SomStatus::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'hex_color' => $this->faker->word,
        'name' => $this->faker->word,
        'type' => $this->faker->word,
        'icon' => $this->faker->word,
        'display_text' => $this->faker->word,
        'is_behaviour_completed' => $this->faker->word,
        'is_behaviour_rejected' => $this->faker->word,
        'is_behaviour_ongoing' => $this->faker->word,
        'is_behaviour_review' => $this->faker->word
        ];
    }
}
