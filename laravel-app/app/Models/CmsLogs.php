<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class CmsLogs
 * @package App\Models
 * @version July 5, 2021, 9:04 am UTC
 *
 * @property string $ipaddress
 * @property string $useragent
 * @property string $url
 * @property string $description
 * @property string $details
 * @property integer $id_cms_users
 * @property string|\Carbon\Carbon $created_at
 * @property string|\Carbon\Carbon $updated_at
 */
class CmsLogs extends Model
{

    use HasFactory;

    public $table = 'cms_logs';
    
    public $timestamps = false;




    public $fillable = [
        'ipaddress',
        'useragent',
        'url',
        'description',
        'details',
        'id_cms_users',
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
        'ipaddress' => 'string',
        'useragent' => 'string',
        'url' => 'string',
        'description' => 'string',
        'details' => 'string',
        'id_cms_users' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'ipaddress' => 'nullable|string|max:50',
        'useragent' => 'nullable|string|max:255',
        'url' => 'nullable|string|max:255',
        'description' => 'nullable|string|max:500',
        'details' => 'nullable|string',
        'id_cms_users' => 'nullable|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
