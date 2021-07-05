<?php

namespace Database\Factories;

use App\Models\CmsSettings;
use Illuminate\Database\Eloquent\Factories\Factory;

class CmsSettingsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CmsSettings::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
        'content' => $this->faker->text,
        'content_input_type' => $this->faker->word,
        'dataenum' => $this->faker->word,
        'helper' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'group_setting' => $this->faker->word,
        'label' => $this->faker->word
        ];
    }
}
