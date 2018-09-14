<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\UmdSubscriber;

class SubscriberController extends Controller
{

	public function news(Request $request){
		if(!UmdSubscriber::where('email', $request->input('email'))->exists()){
			$subscriber = new UmdSubscriber();
			$subscriber->email = $request->input('email');
			$subscriber->fname = $request->input('fname');
			$subscriber->lname = $request->input('lname');
			$subscriber->city = $request->input('city');
			$subscriber->job = $request->input('job');
			$subscriber->cin = $request->input('cin');
			$subscriber->phone = $request->input('phone');
			$subscriber->date = $request->input('date');
			$subscriber->save();
		}
		return redirect()->back()->with('message', 'طلب العضوية تم بنجاح');
	}

	public function sub(){
		$members = UmdSubscriber::get();
		return view('admin.members', compact("members"));
	}

	public function del($id){

		$post = UmdSubscriber::FindOrFail($id)->delete();
		return redirect()->back();
	}

}
