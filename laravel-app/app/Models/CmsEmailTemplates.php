<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class CmsEmailTemplates
 * @package App\Models
 * @version July 5, 2021, 9:15 am UTC
 *
 * @property string $name
 * @property string $slug
 * @property string $subject
 * @property string $content
 * @property string $description
 * @property string $from_name
 * @property string $from_email
 * @property string $cc_email
 * @property string|\Carbon\Carbon $created_at
 * @property string|\Carbon\Carbon $updated_at
 */
class CmsEmailTemplates extends Model
{

    use HasFactory;

    public $table = 'cms_email_templates';
    
    public $timestamps = false;




    public $fillable = [
        'name',
        'slug',
        'subject',
        'content',
        'description',
        'from_name',
        'from_email',
        'cc_email',
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
        'slug' => 'string',
        'subject' => 'string',
        'content' => 'string',
        'description' => 'string',
        'from_name' => 'string',
        'from_email' => 'string',
        'cc_email' => 'string',
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
        'slug' => 'nullable|string|max:255',
        'subject' => 'nullable|string|max:255',
        'content' => 'nullable|string',
        'description' => 'nullable|string|max:255',
        'from_name' => 'nullable|string|max:255',
        'from_email' => 'nullable|string|max:255',
        'cc_email' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
