<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class CmsMenus
 * @package App\Models
 * @version July 5, 2021, 9:14 am UTC
 *
 * @property string $name
 * @property string $type
 * @property string $path
 * @property string $color
 * @property string $icon
 * @property integer $parent_id
 * @property boolean $is_active
 * @property boolean $is_dashboard
 * @property integer $id_cms_privileges
 * @property integer $sorting
 * @property string|\Carbon\Carbon $created_at
 * @property string|\Carbon\Carbon $updated_at
 */
class CmsMenus extends Model
{

    use HasFactory;

    public $table = 'cms_menus';
    
    public $timestamps = false;




    public $fillable = [
        'name',
        'type',
        'path',
        'color',
        'icon',
        'parent_id',
        'is_active',
        'is_dashboard',
        'id_cms_privileges',
        'sorting',
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
        'name' => 'string',
        'type' => 'string',
        'path' => 'string',
        'color' => 'string',
        'icon' => 'string',
        'parent_id' => 'integer',
        'is_active' => 'boolean',
        'is_dashboard' => 'boolean',
        'id_cms_privileges' => 'integer',
        'sorting' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'nullable|string|max:255',
        'type' => 'required|string|max:255',
        'path' => 'nullable|string|max:255',
        'color' => 'nullable|string|max:255',
        'icon' => 'nullable|string|max:255',
        'parent_id' => 'nullable|integer',
        'is_active' => 'required|boolean',
        'is_dashboard' => 'required|boolean',
        'id_cms_privileges' => 'nullable|integer',
        'sorting' => 'nullable|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
