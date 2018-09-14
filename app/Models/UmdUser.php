<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UmdUser
 */
class UmdUser extends Model
{
    protected $table = 'umd_users';

    protected $primaryKey = 'ID';

	public $timestamps = false;

    protected $fillable = [
        'user_login',
        'user_pass',
        'user_email'
    ];

    protected $guarded = [];

	public function UmdPosts(){
		return $this->hasMany('App\Models\UmdPost', 'post_author');
	}

}
