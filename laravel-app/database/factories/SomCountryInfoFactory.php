<?php

namespace Database\Factories;

use App\Models\SomCountryInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

class SomCountryInfoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SomCountryInfo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'som_country_id' => $this->faker->randomDigitNotNull,
        'year' => $this->faker->word,
        'population' => $this->faker->word,
        'inflation' => $this->faker->word,
        'gpd_evolution' => $this->faker->word
        ];
    }
}
