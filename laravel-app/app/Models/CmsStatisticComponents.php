<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class CmsStatisticComponents
 * @package App\Models
 * @version July 5, 2021, 9:05 am UTC
 *
 * @property integer $id_cms_statistics
 * @property string $componentID
 * @property string $component_name
 * @property string $area_name
 * @property integer $sorting
 * @property string $name
 * @property string $config
 * @property string|\Carbon\Carbon $created_at
 * @property string|\Carbon\Carbon $updated_at
 */
class CmsStatisticComponents extends Model
{

    use HasFactory;

    public $table = 'cms_statistic_components';
    
    public $timestamps = false;




    public $fillable = [
        'id_cms_statistics',
        'componentID',
        'component_name',
        'area_name',
        'sorting',
        'name',
        'config',
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
        'id_cms_statistics' => 'integer',
        'componentID' => 'string',
        'component_name' => 'string',
        'area_name' => 'string',
        'sorting' => 'integer',
        'name' => 'string',
        'config' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'id_cms_statistics' => 'nullable|integer',
        'componentID' => 'nullable|string|max:255',
        'component_name' => 'nullable|string|max:255',
        'area_name' => 'nullable|string|max:55',
        'sorting' => 'nullable|integer',
        'name' => 'nullable|string|max:255',
        'config' => 'nullable|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
