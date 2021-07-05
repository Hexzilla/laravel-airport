<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class CmsSettings
 * @package App\Models
 * @version July 5, 2021, 9:08 am UTC
 *
 * @property string $name
 * @property string $content
 * @property string $content_input_type
 * @property string $dataenum
 * @property string $helper
 * @property string|\Carbon\Carbon $created_at
 * @property string|\Carbon\Carbon $updated_at
 * @property string $group_setting
 * @property string $label
 */
class CmsSettings extends Model
{

    use HasFactory;

    public $table = 'cms_settings';
    
    public $timestamps = false;




    public $fillable = [
        'name',
        'content',
        'content_input_type',
        'dataenum',
        'helper',
        'created_at',
        'updated_at',
        'group_setting',
        'label'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'content' => 'string',
        'content_input_type' => 'string',
        'dataenum' => 'string',
        'helper' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'group_setting' => 'string',
        'label' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'nullable|string|max:255',
        'content' => 'nullable|string',
        'content_input_type' => 'nullable|string|max:255',
        'dataenum' => 'nullable|string|max:255',
        'helper' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'group_setting' => 'nullable|string|max:255',
        'label' => 'nullable|string|max:255'
    ];

    
}
