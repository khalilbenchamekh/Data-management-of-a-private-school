<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

use Auth;
use App\User;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

	public function __construct(){
		if (Auth::check()) {
			$user = User::find(Auth::user()->id);
			$role = $user->isWhat();
			view()->share(compact("role"));
		}else{
			$role = "";
		}

	}

}
