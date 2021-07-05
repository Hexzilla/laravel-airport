<?php

namespace Database\Factories;

use App\Models\SomProjectsAirport;
use Illuminate\Database\Eloquent\Factories\Factory;

class SomProjectsAirportFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SomProjectsAirport::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
        'address' => $this->faker->word,
        'city' => $this->faker->word,
        'country' => $this->faker->word,
        'lat' => $this->faker->word,
        'long' => $this->faker->word,
        'iata_oaci' => $this->faker->word,
        'som_projects_airport_type_id' => $this->faker->randomDigitNotNull,
        'size' => $this->faker->word,
        'revenues_aeronautical' => $this->faker->word,
        'revenues_non_aeronautical' => $this->faker->word,
        'total_revenues' => $this->faker->word,
        'total_opex' => $this->faker->word,
        'ebitda' => $this->faker->word,
        'kpi_revenues_aeronautical' => $this->faker->word,
        'kpi_revenues_non_aeronautical' => $this->faker->word,
        'kpi_ebitda' => $this->faker->word,
        'percentage_international' => $this->faker->word,
        'percentage_transfer' => $this->faker->word,
        'percentage_non_low_cost' => $this->faker->word,
        'infrastructure_characterization_description' => $this->faker->word,
        'airport_catchment_area' => $this->faker->word,
        'competitors' => $this->faker->word,
        'top1_airline' => $this->faker->word,
        'top2_airline' => $this->faker->word,
        'top3_airline' => $this->faker->word,
        'top1_airline_percentage' => $this->faker->word,
        'top2_airline_percentage' => $this->faker->word,
        'top3_airline_percentage' => $this->faker->word,
        'route' => $this->faker->word,
        'master_plan_estimations' => $this->faker->word,
        'society_model_regulation' => $this->faker->word,
        'aena_network_improvement' => $this->faker->word,
        'debt_ebitda' => $this->faker->word,
        'img_url' => $this->faker->word,
        'som_country_id' => $this->faker->randomDigitNotNull,
        'other_info' => $this->faker->word,
        'data_year' => $this->faker->randomDigitNotNull,
        'version_date' => $this->faker->word
        ];
    }
}
