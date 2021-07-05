<?php

namespace Database\Factories;

use App\Models\SomFormElements;
use Illuminate\Database\Eloquent\Factories\Factory;

class SomFormElementsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SomFormElements::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
        'document' => $this->faker->word,
        'doc_url_description' => $this->faker->word,
        'template' => $this->faker->word,
        'template_url_description' => $this->faker->word,
        'lastupdate' => $this->faker->word,
        'comment' => $this->faker->word,
        'som_forms_id' => $this->faker->randomDigitNotNull,
        'order_elements' => $this->faker->randomDigitNotNull,
        'is_mandatory' => $this->faker->word,
        'is_sub_element' => $this->faker->word,
        'tooltip' => $this->faker->word,
        'cms_privileges_role_id' => $this->faker->randomDigitNotNull
        ];
    }
}
