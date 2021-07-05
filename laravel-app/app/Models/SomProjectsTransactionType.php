<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class SomProjectsTransactionType
 * @package App\Models
 * @version July 5, 2021, 9:46 am UTC
 *
 * @property string $name
 */
class SomProjectsTransactionType extends Model
{

    use HasFactory;

    public $table = 'som_projects_transaction_type';
    
    public $timestamps = false;




    public $fillable = [
        'name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'nullable|string|max:55'
    ];

    
}
