<?php

namespace Database\Factories;

use App\Models\SomFormTasks;
use Illuminate\Database\Eloquent\Factories\Factory;

class SomFormTasksFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SomFormTasks::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
        'duedate' => $this->faker->word,
        'task_completion_date' => $this->faker->word,
        'request_date' => $this->faker->word,
        'comment' => $this->faker->word,
        'tooltip' => $this->faker->word,
        'support_doc_url' => $this->faker->word,
        'support_doc_description' => $this->faker->word,
        'som_status_id' => $this->faker->randomDigitNotNull,
        'som_forms_id' => $this->faker->randomDigitNotNull,
        'order' => $this->faker->randomDigitNotNull,
        'som_departments_users_id' => $this->faker->randomDigitNotNull,
        'som_departments_id' => $this->faker->randomDigitNotNull,
        'is_sub_task' => $this->faker->word,
        'cms_users_id' => $this->faker->randomDigitNotNull,
        'cms_privileges_role_id' => $this->faker->randomDigitNotNull,
        'consultable_user_name' => $this->faker->word,
        'consultable_user_email' => $this->faker->word
        ];
    }
}
