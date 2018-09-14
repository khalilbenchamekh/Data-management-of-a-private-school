<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UmdOption
 */
class UmdOption extends Model
{
    protected $table = 'umd_options';

    protected $primaryKey = 'option_id';

	public $timestamps = false;

    protected $fillable = [
        'option_name',
        'option_value',
        'autoload'
    ];

    protected $guarded = [];

        
}