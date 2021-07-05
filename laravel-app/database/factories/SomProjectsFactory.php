<?php

namespace Database\Factories;

use App\Models\SomProjects;
use Illuminate\Database\Eloquent\Factories\Factory;

class SomProjectsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SomProjects::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
        'sub_name' => $this->faker->word,
        'grantor' => $this->faker->word,
        'concession_date_start' => $this->faker->word,
        'bid_presentation_date' => $this->faker->word,
        'equity' => $this->faker->word,
        'pr_length' => $this->faker->word,
        'is_template_project' => $this->faker->word,
        'timeoffset' => $this->faker->randomDigitNotNull,
        'is_awarded' => $this->faker->word,
        'is_dismissed' => $this->faker->word,
        'contract_scope' => $this->faker->word,
        'deal_rational' => $this->faker->word,
        'other_requirements' => $this->faker->word,
        'valuation' => $this->faker->word,
        'solvency' => $this->faker->word,
        'documentation_folder' => $this->faker->word,
        'som_status_id' => $this->faker->randomDigitNotNull,
        'som_project_process_type_id' => $this->faker->randomDigitNotNull,
        'som_project_priority_id' => $this->faker->randomDigitNotNull,
        'som_project_info_status_id' => $this->faker->randomDigitNotNull,
        'som_projects_model_id' => $this->faker->randomDigitNotNull,
        'som_projects_asset_type_id' => $this->faker->randomDigitNotNull,
        'som_projects_airport_id' => $this->faker->randomDigitNotNull,
        'som_country_id' => $this->faker->randomDigitNotNull,
        'percentage_participation' => $this->faker->word,
        'ev' => $this->faker->word,
        'duration' => $this->faker->word,
        'responsibility' => $this->faker->word,
        'email_legal' => $this->faker->word,
        'email_finance' => $this->faker->word,
        'img_url' => $this->faker->word
        ];
    }
}
