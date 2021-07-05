<?php

namespace Database\Factories;

use App\Models\CmsPrivilegesRoles;
use Illuminate\Database\Eloquent\Factories\Factory;

class CmsPrivilegesRolesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CmsPrivilegesRoles::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'is_visible' => $this->faker->word,
        'is_create' => $this->faker->word,
        'is_read' => $this->faker->word,
        'is_edit' => $this->faker->word,
        'is_delete' => $this->faker->word,
        'id_cms_privileges' => $this->faker->randomDigitNotNull,
        'id_cms_moduls' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
