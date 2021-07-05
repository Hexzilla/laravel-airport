<?php

namespace Database\Factories;

use App\Models\CmsEmailQueues;
use Illuminate\Database\Eloquent\Factories\Factory;

class CmsEmailQueuesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CmsEmailQueues::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'send_at' => $this->faker->date('Y-m-d H:i:s'),
        'email_recipient' => $this->faker->word,
        'email_from_email' => $this->faker->word,
        'email_from_name' => $this->faker->word,
        'email_cc_email' => $this->faker->word,
        'email_subject' => $this->faker->word,
        'email_content' => $this->faker->text,
        'email_attachments' => $this->faker->text,
        'is_sent' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
