<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class SomNews
 * @package App\Models
 * @version July 5, 2021, 9:30 am UTC
 *
 * @property string $title
 * @property string $news_description
 * @property string $date_from
 * @property string $date_until
 */
class SomNews extends Model
{

    use HasFactory;

    public $table = 'som_news';
    
    public $timestamps = false;




    public $fillable = [
        'title',
        'news_description',
        'date_from',
        'date_until'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'news_description' => 'string',
        'date_from' => 'date',
        'date_until' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required|string|max:100',
        'news_description' => 'required|string|max:1000',
        'date_from' => 'required',
        'date_until' => 'nullable|after_or_equal:date_from'
    ];

    
}
