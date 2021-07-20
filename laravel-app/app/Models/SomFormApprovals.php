<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class SomFormApprovals
 * @package App\Models
 * @version July 5, 2021, 9:25 am UTC
 *
 * @property \App\Models\SomForm $somForms
 * @property \Illuminate\Database\Eloquent\Collection $somApprovalsResponsibles
 * @property string $name
 * @property integer $som_forms_id
 * @property integer $order_approval
 */
class SomFormApprovals extends Model
{

    use HasFactory;

    public $table = 'som_form_approvals';
    
    public $timestamps = false;




    public $fillable = [
        'name',
        'som_forms_id',
        'order_approval'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'som_forms_id' => 'integer',
        'order_approval' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:255',
        'som_forms_id' => 'required|integer|min:0',
        'order_approval' => 'required|integer|min:0'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function somForms()
    {
        return $this->belongsTo(\App\Models\SomForm::class, 'som_forms_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function somApprovalsResponsibles()
    {
        return $this->hasMany(\App\Models\SomApprovalsResponsible::class, 'som_form_approvals_id');
    }
}
