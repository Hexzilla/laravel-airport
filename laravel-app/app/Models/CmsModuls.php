<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class CmsModuls
 * @package App\Models
 * @version July 5, 2021, 9:12 am UTC
 *
 * @property string $name
 * @property string $icon
 * @property string $path
 * @property string $table_name
 * @property string $controller
 * @property boolean $is_protected
 * @property boolean $is_active
 * @property string|\Carbon\Carbon $created_at
 * @property string|\Carbon\Carbon $updated_at
 * @property string|\Carbon\Carbon $deleted_at
 */
class CmsModuls extends Model
{

    use HasFactory;

    public $table = 'cms_moduls';
    
    public $timestamps = false;




    public $fillable = [
        'name',
        'icon',
        'path',
        'table_name',
        'controller',
        'is_protected',
        'is_active',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'icon' => 'string',
        'path' => 'string',
        'table_name' => 'string',
        'controller' => 'string',
        'is_protected' => 'boolean',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'nullable|string|max:255',
        'icon' => 'nullable|string|max:255',
        'path' => 'nullable|string|max:255',
        'table_name' => 'nullable|string|max:255',
        'controller' => 'nullable|string|max:255',
        'is_protected' => 'required|boolean',
        'is_active' => 'required|boolean',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    
}
