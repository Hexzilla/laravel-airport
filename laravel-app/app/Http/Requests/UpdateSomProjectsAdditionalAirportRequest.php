<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\SomProjectsAdditionalAirport;

class UpdateSomProjectsAdditionalAirportRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->request->get('som_project_additional_airporty_id');
        $rules = SomProjectsAdditionalAirport::$rules;
        $rules['som_airport_id'] .= '|unique:som_projects_additional_airport,som_airport_id,' . $id . ',id,som_project_id,'. $this->request->get('som_project_id', 0);
        return $rules;
    }
}
