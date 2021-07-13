<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\SomProjectsPhases;

class CreateSomProjectsPhasesRequest extends FormRequest
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
        $rules = SomProjectsPhases::$rules;
        $rules['som_phases_id'] .= '|unique:som_projects_phases,som_phases_id,null,id,som_projects_id,'. $this->request->get('som_projects_id', 0);
        return $rules;
    }
}
