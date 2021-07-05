<?php

namespace Database\Factories;

use App\Models\CmsPrivileges;
use Illuminate\Database\Eloquent\Factories\Factory;

class CmsPrivilegesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CmsPrivileges::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
        'is_superadmin' => $this->faker->word,
        'theme_color' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'is_app_role' => $this->faker->word,
        'is_project_role' => $this->faker->word
        ];
    }
}
