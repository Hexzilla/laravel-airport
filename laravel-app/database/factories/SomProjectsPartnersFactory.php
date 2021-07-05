<?php

namespace Database\Factories;

use App\Models\SomProjectsPartners;
use Illuminate\Database\Eloquent\Factories\Factory;

class SomProjectsPartnersFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SomProjectsPartners::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
        'som_projects_id' => $this->faker->randomDigitNotNull,
        'company' => $this->faker->word,
        'company_profile' => $this->faker->word,
        'role_in_project' => $this->faker->word,
        'email' => $this->faker->word,
        'phone_number' => $this->faker->word,
        'other_information' => $this->faker->word
        ];
    }
}
