<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class CmsApiCustom
 * @package App\Models
 * @version July 5, 2021, 9:01 am UTC
 *
 * @property string $permalink
 * @property string $tabel
 * @property string $aksi
 * @property string $kolom
 * @property string $orderby
 * @property string $sub_query_1
 * @property string $sql_where
 * @property string $nama
 * @property string $keterangan
 * @property string $parameter
 * @property string|\Carbon\Carbon $created_at
 * @property string|\Carbon\Carbon $updated_at
 * @property string $method_type
 * @property string $parameters
 * @property string $responses
 */
class CmsApiCustom extends Model
{

    use HasFactory;

    public $table = 'cms_apicustom';
    
    public $timestamps = false;




    public $fillable = [
        'permalink',
        'tabel',
        'aksi',
        'kolom',
        'orderby',
        'sub_query_1',
        'sql_where',
        'nama',
        'keterangan',
        'parameter',
        'created_at',
        'updated_at',
        'method_type',
        'parameters',
        'responses'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'permalink' => 'string',
        'tabel' => 'string',
        'aksi' => 'string',
        'kolom' => 'string',
        'orderby' => 'string',
        'sub_query_1' => 'string',
        'sql_where' => 'string',
        'nama' => 'string',
        'keterangan' => 'string',
        'parameter' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'method_type' => 'string',
        'parameters' => 'string',
        'responses' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'permalink' => 'nullable|string|max:255',
        'tabel' => 'nullable|string|max:255',
        'aksi' => 'nullable|string|max:255',
        'kolom' => 'nullable|string|max:255',
        'orderby' => 'nullable|string|max:255',
        'sub_query_1' => 'nullable|string|max:255',
        'sql_where' => 'nullable|string|max:255',
        'nama' => 'nullable|string|max:255',
        'keterangan' => 'nullable|string|max:255',
        'parameter' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'method_type' => 'nullable|string|max:25',
        'parameters' => 'nullable|string',
        'responses' => 'nullable|string'
    ];

    
}
