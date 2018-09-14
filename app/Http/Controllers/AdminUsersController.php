<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Role;
use Hash;

class AdminUsersController extends Controller
{
	public function __construct(){
		$this->middleware('admin');
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$users = User::get();
		return view('admin.users.users', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$roles = Role::get();

		$roless = [];
		foreach ($roles as $role) {
			$roless[$role->id] = $role->role;
		}


        return view('admin.users.new', compact("roless"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

		if( $request->hasFile('attachment') ) {
	        $file = $request->file('attachment');
			$file->move(public_path() . "/uploads" , $file->getClientOriginalName());
	        $user_pic = $file->getClientOriginalName();
	    }else {
	    	$user_pic = "default_profile.jpg";
	    }

        User::create(['name' => $request->input('user-name'), 'email' => $request->input('user-email') ,'password' => Hash::make($request->input('user-password')), 'role_id' => $request->input('role'),  'user_pic' => $user_pic]);

		return redirect(route('admin.users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$user = User::FindOrFail($id);
		$user->delete();
		return redirect(route('admin.users.index'));
    }
}
