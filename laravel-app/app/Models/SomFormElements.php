<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class SomFormElements
 * @package App\Models
 * @version July 5, 2021, 9:26 am UTC
 *
 * @property \App\Models\CmsPrivilege $cmsPrivilegesRole
 * @property \App\Models\SomForm $somForms
 * @property string $name
 * @property string $document
 * @property string $doc_url_description
 * @property string $template
 * @property string $template_url_description
 * @property string $lastupdate
 * @property string $comment
 * @property integer $som_forms_id
 * @property integer $order_elements
 * @property boolean $is_mandatory
 * @property boolean $is_sub_element
 * @property string $tooltip
 * @property integer $cms_privileges_role_id
 */
class SomFormElements extends Model
{

    use HasFactory;

    public $table = 'som_form_elements';
    
    public $timestamps = false;




    public $fillable = [
        'name',
        'document',
        'doc_url_description',
        'template',
        'template_url_description',
        'lastupdate',
        'comment',
        'som_forms_id',
        'order_elements',
        'is_mandatory',
        'is_sub_element',
        'tooltip',
        'cms_privileges_role_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'document' => 'string',
        'doc_url_description' => 'string',
        'template' => 'string',
        'template_url_description' => 'string',
        'lastupdate' => 'date',
        'comment' => 'string',
        'som_forms_id' => 'integer',
        'order_elements' => 'integer',
        'is_mandatory' => 'boolean',
        'is_sub_element' => 'boolean',
        'tooltip' => 'string',
        'cms_privileges_role_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|min:3|max:170',
        'document' => 'nullable|string|max:1000',
        'doc_url_description' => 'nullable|string|max:255',
        'template' => 'nullable|string|max:1000',
        'template_url_description' => 'nullable|string|max:255',
        'lastupdate' => 'nullable',
        'comment' => 'nullable|string|max:255',
        'som_forms_id' => 'required|integer|min:0',
        'order_elements' => 'required|integer|min:0',
        'is_mandatory' => 'required|boolean',
        'is_sub_element' => 'required|integer',
        'tooltip' => 'nullable|string|max:2000',
        'cms_privileges_role_id' => 'required|integer|min:1'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function cmsPrivilegesRole()
    {
        return $this->belongsTo(\App\Models\CmsPrivilege::class, 'cms_privileges_role_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function somForms()
    {
        return $this->belongsTo(\App\Models\SomForm::class, 'som_forms_id');
    }
}
