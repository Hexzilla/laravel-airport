<?php

namespace Database\Factories;

use App\Models\CmsDashboard;
use Illuminate\Database\Eloquent\Factories\Factory;

class CmsDashboardFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CmsDashboard::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
        'id_cms_privileges' => $this->faker->randomDigitNotNull,
        'content' => $this->faker->text,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
