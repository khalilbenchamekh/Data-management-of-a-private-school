<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','user_pic', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

	public function UmdPosts(){
		return $this->hasMany('App\Models\UmdPost', 'post_author');
	}

	public function Role(){
		return $this->belongsTo('App\Role', 'role_id', 'id');
	}

	public function isAdmin(){
		$role = Role::find($this->role_id)->role;
		return $role == "admin" ? true : false;
	}

	public function isManager(){
		$role = Role::find($this->role_id)->role;
		return $role == "manager" ? true : false;
	}

	public function isReporter(){
		$role = Role::find($this->role_id)->role;
		return $role == "reporter" ? true : false;
	}

	public function isWhat(){
		$role = Role::find($this->role_id)->role;
		return $role;
	}
}
