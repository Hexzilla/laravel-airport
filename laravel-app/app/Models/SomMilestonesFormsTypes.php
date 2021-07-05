<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class SomMilestonesFormsTypes
 * @package App\Models
 * @version July 5, 2021, 9:29 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $somForms
 * @property string $name
 */
class SomMilestonesFormsTypes extends Model
{

    use HasFactory;

    public $table = 'som_milestones_forms_types';
    
    public $timestamps = false;




    public $fillable = [
        'name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:45'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function somForms()
    {
        return $this->hasMany(\App\Models\SomForm::class, 'som_milestones_forms_types_id');
    }
}
