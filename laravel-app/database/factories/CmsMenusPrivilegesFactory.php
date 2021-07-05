<?php

namespace Database\Factories;

use App\Models\CmsMenusPrivileges;
use Illuminate\Database\Eloquent\Factories\Factory;

class CmsMenusPrivilegesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CmsMenusPrivileges::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_cms_menus' => $this->faker->randomDigitNotNull,
        'id_cms_privileges' => $this->faker->randomDigitNotNull
        ];
    }
}
