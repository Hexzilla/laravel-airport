<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class SomPhases
 * @package App\Models
 * @version July 5, 2021, 9:31 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $somProjectsPhases
 * @property string $name
 * @property string $hex_color
 * @property boolean $is_visible
 */
class SomPhases extends Model
{

    use HasFactory;

    public $table = 'som_phases';
    
    public $timestamps = false;




    public $fillable = [
        'name',
        'hex_color',
        'is_visible'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'hex_color' => 'string',
        'is_visible' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:255',
        'hex_color' => 'nullable|string|max:8',
        'is_visible' => 'required|boolean'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function somProjectsPhases()
    {
        return $this->hasMany(\App\Models\SomProjectsPhase::class, 'som_phases_id');
    }
}
