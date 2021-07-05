<?php

namespace Database\Factories;

use App\Models\CmsMenus;
use Illuminate\Database\Eloquent\Factories\Factory;

class CmsMenusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CmsMenus::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
        'type' => $this->faker->word,
        'path' => $this->faker->word,
        'color' => $this->faker->word,
        'icon' => $this->faker->word,
        'parent_id' => $this->faker->randomDigitNotNull,
        'is_active' => $this->faker->word,
        'is_dashboard' => $this->faker->word,
        'id_cms_privileges' => $this->faker->randomDigitNotNull,
        'sorting' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
