<?php

namespace Database\Factories;

use App\Models\SomCountry;
use Illuminate\Database\Eloquent\Factories\Factory;

class SomCountryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SomCountry::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'country' => $this->faker->word,
        'country_code' => $this->faker->word,
        'description' => $this->faker->word,
        'politics' => $this->faker->randomDigitNotNull,
        'regulatory' => $this->faker->randomDigitNotNull,
        'corruption' => $this->faker->randomDigitNotNull,
        'business_easyness' => $this->faker->randomDigitNotNull,
        'spain_affinity' => $this->faker->randomDigitNotNull,
        'aena_strategy_align' => $this->faker->word,
        'tourism_activity' => $this->faker->word,
        'country_risk' => $this->faker->word,
        'imports_exports' => $this->faker->word,
        'version_date' => $this->faker->word,
        'exchange_rate' => $this->faker->word
        ];
    }
}
