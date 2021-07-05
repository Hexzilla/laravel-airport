<?php

namespace Database\Factories;

use App\Models\CmsLogs;
use Illuminate\Database\Eloquent\Factories\Factory;

class CmsLogsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CmsLogs::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ipaddress' => $this->faker->word,
        'useragent' => $this->faker->word,
        'url' => $this->faker->word,
        'description' => $this->faker->word,
        'details' => $this->faker->text,
        'id_cms_users' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
