<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class SomStatusApprovals
 * @package App\Models
 * @version July 5, 2021, 9:48 am UTC
 *
 * @property \App\Models\SomApprovalsResponsible $somApprovalsResponsible
 * @property \App\Models\SomStatus $somStatus
 * @property integer $som_status_id
 * @property integer $som_approvals_responsible_id
 * @property integer $status_order
 */
class SomStatusApprovals extends Model
{

    use HasFactory;

    public $table = 'som_status_approvals';
    
    public $timestamps = false;




    public $fillable = [
        'som_status_id',
        'som_approvals_responsible_id',
        'status_order'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'som_status_id' => 'integer',
        'som_approvals_responsible_id' => 'integer',
        'status_order' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'som_status_id' => 'required|integer',
        'som_approvals_responsible_id' => 'required|integer',
        'status_order' => 'required|integer'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function somApprovalsResponsible()
    {
        return $this->belongsTo(\App\Models\SomApprovalsResponsible::class, 'som_approvals_responsible_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function somStatus()
    {
        return $this->belongsTo(\App\Models\SomStatus::class, 'som_status_id');
    }
}
