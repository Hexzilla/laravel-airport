<?php

namespace Database\Factories;

use App\Models\CmsModuls;
use Illuminate\Database\Eloquent\Factories\Factory;

class CmsModulsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CmsModuls::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
        'icon' => $this->faker->word,
        'path' => $this->faker->word,
        'table_name' => $this->faker->word,
        'controller' => $this->faker->word,
        'is_protected' => $this->faker->word,
        'is_active' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
