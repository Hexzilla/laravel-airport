<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class SomProjectsAirportType
 * @package App\Models
 * @version July 5, 2021, 9:40 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $somProjectsAirports
 * @property string $name
 */
class SomProjectsAirportType extends Model
{

    use HasFactory;

    public $table = 'som_projects_airport_type';
    
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
        'name' => 'nullable|string|max:45'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function somProjectsAirports()
    {
        return $this->hasMany(\App\Models\SomProjectsAirport::class, 'som_projects_airport_type_id');
    }
}
