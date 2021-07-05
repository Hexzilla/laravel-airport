<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class CmsDashboard
 * @package App\Models
 * @version July 5, 2021, 9:17 am UTC
 *
 * @property string $name
 * @property integer $id_cms_privileges
 * @property string $content
 * @property string|\Carbon\Carbon $created_at
 * @property string|\Carbon\Carbon $updated_at
 */
class CmsDashboard extends Model
{

    use HasFactory;

    public $table = 'cms_dashboard';
    
    public $timestamps = false;




    public $fillable = [
        'name',
        'id_cms_privileges',
        'content',
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
        'id_cms_privileges' => 'integer',
        'content' => 'string',
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
        'id_cms_privileges' => 'nullable|integer',
        'content' => 'nullable|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
