<?php

namespace Database\Factories;

use App\Models\CmsStatisticComponents;
use Illuminate\Database\Eloquent\Factories\Factory;

class CmsStatisticComponentsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CmsStatisticComponents::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_cms_statistics' => $this->faker->randomDigitNotNull,
        'componentID' => $this->faker->word,
        'component_name' => $this->faker->word,
        'area_name' => $this->faker->word,
        'sorting' => $this->faker->randomDigitNotNull,
        'name' => $this->faker->word,
        'config' => $this->faker->text,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
