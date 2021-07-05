<?php

namespace Database\Factories;

use App\Models\SomApprovalsResponsible;
use Illuminate\Database\Eloquent\Factories\Factory;

class SomApprovalsResponsibleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SomApprovalsResponsible::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'lastupdate' => $this->faker->word,
        'comment' => $this->faker->word,
        'som_form_approvals_id' => $this->faker->randomDigitNotNull,
        'som_status_id' => $this->faker->randomDigitNotNull,
        'document_url' => $this->faker->word,
        'doc_url_description' => $this->faker->word,
        'order_approval' => $this->faker->randomDigitNotNull,
        'is_final_approval' => $this->faker->word,
        'cms_privilege_id_assigned' => $this->faker->randomDigitNotNull,
        'cms_privilege_id_notify' => $this->faker->randomDigitNotNull
        ];
    }
}
