<?php

namespace Database\Factories;

use App\Models\CmsApiCustom;
use Illuminate\Database\Eloquent\Factories\Factory;

class CmsApiCustomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CmsApiCustom::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'permalink' => $this->faker->word,
        'tabel' => $this->faker->word,
        'aksi' => $this->faker->word,
        'kolom' => $this->faker->word,
        'orderby' => $this->faker->word,
        'sub_query_1' => $this->faker->word,
        'sql_where' => $this->faker->word,
        'nama' => $this->faker->word,
        'keterangan' => $this->faker->word,
        'parameter' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'method_type' => $this->faker->word,
        'parameters' => $this->faker->text,
        'responses' => $this->faker->text
        ];
    }
}
