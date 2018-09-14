<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

	protected $table = 'roles';

	protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'role'
    ];

    protected $guarded = [];


	public function Users(){
		return $this->hasMany('App\User', 'role_id');
	}
}
