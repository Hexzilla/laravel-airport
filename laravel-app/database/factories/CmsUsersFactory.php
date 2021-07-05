<?php

namespace Database\Factories;

use App\Models\CmsUsers;
use Illuminate\Database\Eloquent\Factories\Factory;

class CmsUsersFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CmsUsers::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'photo' => $this->faker->word,
            'email' => $this->faker->unique()->safeEmail,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'id_cms_privileges' => $this->faker->randomDigitNotNull,
            'created_at' => now(),
            'updated_at' => now(),
            'status' => $this->faker->word,
            'job_title' => $this->faker->word,
            'objectguid' => $this->faker->word,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ];
    }
}