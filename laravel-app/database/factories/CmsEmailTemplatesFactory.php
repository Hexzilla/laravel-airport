<?php

namespace Database\Factories;

use App\Models\CmsEmailTemplates;
use Illuminate\Database\Eloquent\Factories\Factory;

class CmsEmailTemplatesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CmsEmailTemplates::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
        'slug' => $this->faker->word,
        'subject' => $this->faker->word,
        'content' => $this->faker->text,
        'description' => $this->faker->word,
        'from_name' => $this->faker->word,
        'from_email' => $this->faker->word,
        'cc_email' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
