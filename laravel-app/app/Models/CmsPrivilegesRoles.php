<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class CmsPrivilegesRoles
 * @package App\Models
 * @version July 5, 2021, 9:09 am UTC
 *
 * @property boolean $is_visible
 * @property boolean $is_create
 * @property boolean $is_read
 * @property boolean $is_edit
 * @property boolean $is_delete
 * @property integer $id_cms_privileges
 * @property integer $id_cms_moduls
 * @property string|\Carbon\Carbon $created_at
 * @property string|\Carbon\Carbon $updated_at
 */
class CmsPrivilegesRoles extends Model
{

    use HasFactory;

    public $table = 'cms_privileges_roles';
    
    public $timestamps = false;




    public $fillable = [
        'is_visible',
        'is_create',
        'is_read',
        'is_edit',
        'is_delete',
        'id_cms_privileges',
        'id_cms_moduls',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'is_visible' => 'boolean',
        'is_create' => 'boolean',
        'is_read' => 'boolean',
        'is_edit' => 'boolean',
        'is_delete' => 'boolean',
        'id_cms_privileges' => 'integer',
        'id_cms_moduls' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'is_visible' => 'nullable|boolean',
        'is_create' => 'nullable|boolean',
        'is_read' => 'nullable|boolean',
        'is_edit' => 'nullable|boolean',
        'is_delete' => 'nullable|boolean',
        'id_cms_privileges' => 'nullable|integer',
        'id_cms_moduls' => 'nullable|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
