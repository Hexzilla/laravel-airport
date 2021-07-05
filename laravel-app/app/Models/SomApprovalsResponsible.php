<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class SomApprovalsResponsible
 * @package App\Models
 * @version July 5, 2021, 9:20 am UTC
 *
 * @property \App\Models\CmsPrivilege $cmsPrivilegeAssigned
 * @property \App\Models\CmsPrivilege $cmsPrivilegeNotify
 * @property \App\Models\SomFormApproval $somFormApprovals
 * @property \App\Models\SomStatus $somStatus
 * @property \Illuminate\Database\Eloquent\Collection $somStatusApprovals
 * @property string $lastupdate
 * @property string $comment
 * @property integer $som_form_approvals_id
 * @property integer $som_status_id
 * @property string $document_url
 * @property string $doc_url_description
 * @property integer $order_approval
 * @property boolean $is_final_approval
 * @property integer $cms_privilege_id_assigned
 * @property integer $cms_privilege_id_notify
 */
class SomApprovalsResponsible extends Model
{

    use HasFactory;

    public $table = 'som_approvals_responsible';
    
    public $timestamps = false;




    public $fillable = [
        'lastupdate',
        'comment',
        'som_form_approvals_id',
        'som_status_id',
        'document_url',
        'doc_url_description',
        'order_approval',
        'is_final_approval',
        'cms_privilege_id_assigned',
        'cms_privilege_id_notify'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'lastupdate' => 'date',
        'comment' => 'string',
        'som_form_approvals_id' => 'integer',
        'som_status_id' => 'integer',
        'document_url' => 'string',
        'doc_url_description' => 'string',
        'order_approval' => 'integer',
        'is_final_approval' => 'boolean',
        'cms_privilege_id_assigned' => 'integer',
        'cms_privilege_id_notify' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'lastupdate' => 'nullable',
        'comment' => 'nullable|string|max:255',
        'som_form_approvals_id' => 'required|integer',
        'som_status_id' => 'nullable|integer',
        'document_url' => 'nullable|string|max:1000',
        'doc_url_description' => 'nullable|string|max:255',
        'order_approval' => 'nullable|integer',
        'is_final_approval' => 'required|boolean',
        'cms_privilege_id_assigned' => 'nullable|integer',
        'cms_privilege_id_notify' => 'nullable|integer'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function cmsPrivilegeAssigned()
    {
        return $this->belongsTo(\App\Models\CmsPrivilege::class, 'cms_privilege_id_assigned');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function cmsPrivilegeNotify()
    {
        return $this->belongsTo(\App\Models\CmsPrivilege::class, 'cms_privilege_id_notify');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function somFormApprovals()
    {
        return $this->belongsTo(\App\Models\SomFormApproval::class, 'som_form_approvals_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function somStatus()
    {
        return $this->belongsTo(\App\Models\SomStatus::class, 'som_status_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function somStatusApprovals()
    {
        return $this->hasMany(\App\Models\SomStatusApproval::class, 'som_approvals_responsible_id');
    }
}
