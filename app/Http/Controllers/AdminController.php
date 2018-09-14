<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use Hash;
use App\User;
use Redirect;

use App\Models\UmdComment;
use App\Models\UmdPost;
use App\Models\UmdOption;
use App\Role;

class AdminController extends Controller
{


	public function index()
	{

		// dd(Auth::user()->isWhat());
	//	User::create(['name' => 'soufiane', 'email' => 'test3@test.com','password' => Hash::make('test@test')]);
		$profile = Auth::user();

		return view('admin.profile', compact("profile"));
	}

	public function login(Request $request){


		if(Auth::attempt($request->only('name', 'password'))){
			return redirect(url('admin'));
		}else {
			$error = "nom d'utilisateur ou/et mot de passe incorrectes";
			return Redirect::to('admin/login')->with('error' , $error);
		}
	}

	public function logout(){
		Auth::logout();
		return redirect(url('admin/login'));
	}

	public function getOptions(){
		$options = UmdOption::get();
		// dd($options);
		return View('admin.options', compact("options"));
	}

	public function postOptions(Request $request){

		$update_option = UmdOption::where('option_name','fb_link')->first();
		$update_option->option_value = $request->input('fb-page');
		$update_option->save();

		$update_option = UmdOption::where('option_name','st_link')->first();
		$update_option->option_value = $request->input('st-page');
		$update_option->save();

		$update_option = UmdOption::where('option_name','tw_link')->first();
		$update_option->option_value = $request->input('tw-page');
		$update_option->save();

		$update_option = UmdOption::where('option_name','yt_api_key')->first();
		$update_option->option_value = $request->input('yt_api_key');
		$update_option->save();

		$update_option = UmdOption::where('option_name','i_link_1')->first();
		$update_option->option_value = $request->input('i_link_1');
		$update_option->save();

		$update_option = UmdOption::where('option_name','i_link_2')->first();
		$update_option->option_value = $request->input('i_link_2');
		$update_option->save();

		$update_option = UmdOption::where('option_name','i_link_3')->first();
		$update_option->option_value = $request->input('i_link_3');
		$update_option->save();

		$update_option = UmdOption::where('option_name','i_link_4')->first();
		$update_option->option_value = $request->input('i_link_4');
		$update_option->save();

		$update_option = UmdOption::where('option_name','i_link_5')->first();
		$update_option->option_value = $request->input('i_link_5');
		$update_option->save();

		$update_option = UmdOption::where('option_name','i_link_1_name')->first();
		$update_option->option_value = $request->input('i_link_1_name');
		$update_option->save();

		$update_option = UmdOption::where('option_name','i_link_2_name')->first();
		$update_option->option_value = $request->input('i_link_2_name');
		$update_option->save();

		$update_option = UmdOption::where('option_name','i_link_3_name')->first();
		$update_option->option_value = $request->input('i_link_3_name');
		$update_option->save();

		$update_option = UmdOption::where('option_name','i_link_4_name')->first();
		$update_option->option_value = $request->input('i_link_4_name');
		$update_option->save();

		$update_option = UmdOption::where('option_name','i_link_5_name')->first();
		$update_option->option_value = $request->input('i_link_5_name');
		$update_option->save();

		$update_option = UmdOption::where('option_name','marquee')->first();
		$update_option->option_value = $request->input('marquee');
		$update_option->save();


		$options = UmdOption::get();
		return View('admin.options', compact("options"));
	}

	public function test(){
		$faker = Faker\Factory::create();

		$limit = 30;

		for ($i = 0; $i < $limit; $i++) {
	        $faker->name . ', Email Address: ' . $faker->unique()->email . ', Contact No' . $faker->phoneNumber . '<br>';
	    }
	}




}
