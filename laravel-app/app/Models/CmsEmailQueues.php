<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class CmsEmailQueues
 * @package App\Models
 * @version July 5, 2021, 9:16 am UTC
 *
 * @property string|\Carbon\Carbon $send_at
 * @property string $email_recipient
 * @property string $email_from_email
 * @property string $email_from_name
 * @property string $email_cc_email
 * @property string $email_subject
 * @property string $email_content
 * @property string $email_attachments
 * @property boolean $is_sent
 * @property string|\Carbon\Carbon $created_at
 * @property string|\Carbon\Carbon $updated_at
 */
class CmsEmailQueues extends Model
{

    use HasFactory;

    public $table = 'cms_email_queues';
    
    public $timestamps = false;




    public $fillable = [
        'send_at',
        'email_recipient',
        'email_from_email',
        'email_from_name',
        'email_cc_email',
        'email_subject',
        'email_content',
        'email_attachments',
        'is_sent',
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
        'send_at' => 'datetime',
        'email_recipient' => 'string',
        'email_from_email' => 'string',
        'email_from_name' => 'string',
        'email_cc_email' => 'string',
        'email_subject' => 'string',
        'email_content' => 'string',
        'email_attachments' => 'string',
        'is_sent' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'send_at' => 'nullable',
        'email_recipient' => 'nullable|string|max:255',
        'email_from_email' => 'nullable|string|max:255',
        'email_from_name' => 'nullable|string|max:255',
        'email_cc_email' => 'nullable|string|max:255',
        'email_subject' => 'nullable|string|max:255',
        'email_content' => 'nullable|string',
        'email_attachments' => 'nullable|string',
        'is_sent' => 'nullable|boolean',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
