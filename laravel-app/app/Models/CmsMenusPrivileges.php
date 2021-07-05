<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class CmsMenusPrivileges
 * @package App\Models
 * @version July 5, 2021, 9:13 am UTC
 *
 * @property integer $id_cms_menus
 * @property integer $id_cms_privileges
 */
class CmsMenusPrivileges extends Model
{

    use HasFactory;

    public $table = 'cms_menus_privileges';
    
    public $timestamps = false;




    public $fillable = [
        'id_cms_menus',
        'id_cms_privileges'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'id_cms_menus' => 'integer',
        'id_cms_privileges' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'id_cms_menus' => 'nullable|integer',
        'id_cms_privileges' => 'nullable|integer'
    ];

    
}
