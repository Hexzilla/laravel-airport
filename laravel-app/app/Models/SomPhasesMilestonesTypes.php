<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class SomPhasesMilestonesTypes
 * @package App\Models
 * @version July 5, 2021, 9:32 am UTC
 *
 * @property string $name
 */
class SomPhasesMilestonesTypes extends Model
{

    use HasFactory;

    public $table = 'som_phases_milestones_types';
    
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
        'name' => 'required|string|max:255'
    ];

    
}
