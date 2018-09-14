<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\User;

class managerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
		if (Auth::check()) {
			$user = User::find(Auth::user()->id);
			$role = $user->isWhat();
			view()->share(compact("role"));
			if ($role != "admin" && $role != "manager") {
	            return redirect('admin');
	        }
			return $next($request);
		}



        return redirect('admin');
    }
}
