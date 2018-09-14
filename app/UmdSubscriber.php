<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UmdSubscriber extends Model
{
	protected $table = 'umd_members';

    protected $primaryKey = 'id';

	public $timestamps = false;

    protected $fillable = [
        'email',
		'date'
    ];

}
