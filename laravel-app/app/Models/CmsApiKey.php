<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class CmsApiKey
 * @package App\Models
 * @version July 5, 2021, 9:03 am UTC
 *
 * @property string $screetkey
 * @property integer $hit
 * @property string $status
 * @property string|\Carbon\Carbon $created_at
 * @property string|\Carbon\Carbon $updated_at
 */
class CmsApiKey extends Model
{

    use HasFactory;

    public $table = 'cms_apikey';
    
    public $timestamps = false;




    public $fillable = [
        'screetkey',
        'hit',
        'status',
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
        'screetkey' => 'string',
        'hit' => 'integer',
        'status' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'screetkey' => 'nullable|string|max:255',
        'hit' => 'nullable|integer',
        'status' => 'required|string|max:25',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
