<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Mail;
use App\Models\UmdPost;
use App\Models\UmdTerm;
use App\Models\UmdTermTaxonomy;
use App\Models\UmdTermRelationship;
use App\Models\UmdComment;
use App\Models\UmdOption;

class PublicController extends Controller
{

	public function home(){



		$newsTerm = UmdTerm::where('name', 'الفضاء الاخباري')->first();
		$newsMenu = UmdTermTaxonomy::where('parent', $newsTerm->term_id)->get();
		$cat = $newsTerm->slug;


		$groups = UmdTermTaxonomy::where('parent', 0)->where('taxonomy', 'group')->get();
		//slider
		$slider = UmdPost::where('post_type', 'post')->orderBy('ID','desc')->take(8)->get();

		$marquee = UmdOption::where('option_name','marquee')->first();

		$events = UmdPost::where('post_type', 'event')->orderBy('post_date')->get();

		$dates = [];
		foreach ($events as $event) {
			array_push($dates, "" . date('d/m/Y', strtotime($event->post_date)));
		}
		$dates = json_encode($dates, JSON_UNESCAPED_SLASHES);
		$dates = html_entity_decode($dates);

		$reporters = UmdPost::where('post_type', 'reporter')->orderBy('post_date')->take(4)->get();

		$press = UmdPost::where('post_type', 'press')->orderBy('post_date')->take(6)->get();

		$notification = UmdPost::where('post_type', 'notification')->where('post_status',1)->get();

		$videos = UmdPost::where('post_type', 'video')->where('post_status',1)->take(8)->get();
		//$selectvideo = 

		return view('welcome', compact("newsMenu", "groups", "cat", "slider", "dates", "marquee", "reporters", "press","notification","videos"));
	}

	public function tv(){
		$YTid = UmdOption::where('option_name', 'yt_api_key')->first();
		$json = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/search?key=' . env('YT_KEY') . 'AIzaSyDDdoYDg1prAjzexBDi8tIZ9E2bNOboauo&part=snippet,id&maxResults=15&channelId='. $YTid->option_value), true);
		// return '<a href="http://youtube.com/watch?v=' . $json["items"][0]["id"]["videoId"] .'"> hello</a>';
		// dd($json);
		return view('tv.tv', compact("json"));
	}

	public function tvid($name, $id){
		$YTid = UmdOption::where('option_name', 'yt_api_key')->first();
		$json = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/search?key=' . env('YT_KEY') . 'AIzaSyDDdoYDg1prAjzexBDi8tIZ9E2bNOboauo&part=snippet,id&maxResults=15&channelId='. $YTid->option_value), true);
		// return '<a href="http://youtube.com/watch?v=' . $json["items"][0]["id"]["videoId"] .'"> hello</a>';
		return view('tv.tv', compact("json", "name", "id"));
	}

	public function category($category){

		$newsTerm = UmdTerm::where('slug', $category)->first();
		if ($newsTerm != null) {
			$newsMenu = UmdTermTaxonomy::where('parent', $newsTerm->term_id)->get();

			$posts = UmdTermRelationship::where('parent', $newsTerm->term_id)->get();

			return view('category', compact("newsMenu", "newsTerm", "category", "posts"));
		}else {
			return view('errors.404');
		}

	}

	public function subCategory($category, $subCategory){
		$newsTerm = UmdTerm::where('slug', $category)->first();
		if ($newsTerm != null) {
			$newsMenu = UmdTermTaxonomy::where('parent', $newsTerm->term_id)->get();

			$sub = UmdTerm::where('slug', $subCategory)->first();
			if ($sub != null) {
				$tax = UmdTermTaxonomy::where('term_id', $sub->term_id)->first();

				$tposts = UmdTermRelationship::where('term_taxonomy_id', $tax->term_taxonomy_id)->get();
				if($category == "الفضاء-الاخباري"){
					return view('mainsubcategory', compact("newsMenu", "newsTerm", "category", "tposts"));
				}
				return view('subcategory', compact("newsMenu", "newsTerm", "category", "sub", "tposts"));
			}else {
				return view('errors.404');
			}

		}else {
			return view('errors.404');
		}

	}

	public function article($category, $subCategory, $postSlug){

		$newsTerm = UmdTerm::where('slug', $category)->first();
		$newsMenu = UmdTermTaxonomy::where('parent', $newsTerm->term_id)->get();
		$cat = $newsTerm->slug;

		$post = UmdPost::where('post_slug', $postSlug)->where('post_type', 'post')->where('post_status', 1)->first();
		if ($newsTerm != null && $newsMenu != null && $post != null) {
			$related = UmdTermRelationship::where('term_taxonomy_id' , $post->UmdTermRelationship->term_taxonomy_id)
											->where('object_id', '!=', $post->ID)
											->orderBy('object_id','desc')
											->take(10)
											->get();

			if($category == "الفضاء-الاخباري"){
				return view('mainarticle', compact("post", "newsMenu", "related", "category", "cat"));
			}
			return view('article', compact("post", "newsMenu", "related", "category", "cat"));
		}else {
			return view('errors.404');
		}


	}

	public function postComment($id, Request $request){
		$recaptcha = new \ReCaptcha\ReCaptcha(env('RE_CAP_SECRET'));
		$response = $request->input('g-recaptcha-response');
		$remoteip = $_SERVER['REMOTE_ADDR'];
		$resp = $recaptcha->verify($response, $remoteip);
		if ($resp->isSuccess()) {
			$comment = new UmdComment();
			$comment->comment_author = $request->input('name');
			$comment->comment_author_email = $request->input('email');
			$comment->comment_content = $request->input('content');
			$comment->comment_post_ID = $id;
			$comment->comment_approved = 0;
			$comment->save();
		    return redirect()->back();
		} else {
		    $errors = $resp->getErrorCodes();
			return redirect()->back();
		}
	}

	public function event($year, $month, $day){
		$newsTerm = UmdTerm::where('name', 'الفضاء الاخباري')->first();
		$newsMenu = UmdTermTaxonomy::where('parent', $newsTerm->term_id)->get();
		$cat = $newsTerm->slug;

		$date = date_create_from_format("d/m/Y H:i:s", $day . "/" . $month . "/" . $year . " 00:00:00");
		$event = UmdPost::where('post_type', 'event')->where('post_date', $date)->first();
		return view('event', compact("event", "newsMenu", "cat"));
	}

	public function press($id){
		$newsTerm = UmdTerm::where('name', 'الفضاء الاخباري')->first();
		$newsMenu = UmdTermTaxonomy::where('parent', $newsTerm->term_id)->get();
		$cat = $newsTerm->slug;
		$post = UmdPost::find($id);
		if ($newsTerm != null && $newsMenu != null && $post != null) {
			$related = UmdPost::where('post_type' , $post->post_type)
											->where('ID', '!=', $post->ID)
											->orderBy('ID','desc')
											->take(10)
											->get();
			return view('aarticle', compact("post", "newsMenu", "related", "cat"));
		}else {
			return view('errors.404');
		}
	}

	public function postSearch(Request $request){
		$posts = UmdPost::where('post_title', 'LIKE', '%'.$request->input('search').'%')->get();
		return view('search', compact("posts"));
	}

	public function contact(Request $request){

		$email = $request->input('email');

		$name = $request->input('name');

		$content = $request->input('message');

		Mail::send('mail', compact("content") , function($message) use ($email, $name){
			$message->from($email, $name);
			$message->to("umdws.dev@gmail.com");
			$message->subject("contact");
		});

		return redirect()->back()->with("contact", "لقد تم الارسال بنجاح");
	}

	public function galerie(){
		$images = UmdPost::where('post_type', 'image')->get();
		return view('galerie.images',compact('images'));
	}

	public function postNotification($title){
		$notification = UmdPost::where('post_type', 'notification')->where('post_title',$title)->get();
		return view('notification', compact("notification"));
	}

	public function postPress(){
		$press = UmdPost::where('post_type', 'press')->get();
		$newsTerm = UmdTerm::where('name', 'الفضاء الاخباري')->first();
		$newsMenu = UmdTermTaxonomy::where('parent', $newsTerm->term_id)->get();
		$cat = $newsTerm->slug;

		$groups = UmdTermTaxonomy::where('parent', 0)->where('taxonomy', 'group')->get();
		//slider
		$slider = UmdPost::where('post_type', 'post')->orderBy('ID','desc')->take(20)->get();

		$marquee = UmdOption::where('option_name','marquee')->first();

		$events = UmdPost::where('post_type', 'event')->orderBy('post_date')->get();

		$dates = [];
		foreach ($events as $event) {
			array_push($dates, "" . date('d/m/Y', strtotime($event->post_date)));
		}
		$dates = json_encode($dates, JSON_UNESCAPED_SLASHES);
		$dates = html_entity_decode($dates);

		$reporters = UmdPost::where('post_type', 'reporter')->orderBy('post_date')->take(4)->get();


		return view('press.article',compact("newsMenu", "groups", "cat", "slider", "dates", "marquee", "reporters", "press","notification"));
	
	}
	public function test(){
			$new = new UmdTerm();
			$new->name = 'بلاغات و بيانات';
			$new->slug = 0;
			$new->term_group = 0;
			$new->save();
			$new1= new UmdTermTaxonomy();
			$new1->term_taxonomy_id=39;
			$new1->term_id=40;
			$new1->taxonomy='group';
			$new1->description='';
			$new1->parent=0;
			$new1->count=0;
			$new1->save();
	        return "insertion faite";
		}


	public function postVideo($idYo){
		$video = UmdPost::where('post_type', 'video')->where('ID',$idYo)->first();
		//$json = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/search?key=' . env('YT_KEY') . 'AIzaSyDDdoYDg1prAjzexBDi8tIZ9E2bNOboauo&part=snippet,id&maxResults=15&channelId='. $video->post_content), true);
		// return '<a href="http://youtube.com/watch?v=' . $json["items"][0]["id"]["videoId"] .'"> hello</a>';
		return view('galerie.video', compact("video"));
	}


	public function toVideos(){
		$videos = UmdPost::where('post_type', 'video')->get();
		//$json = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/search?key=' . env('YT_KEY') . 'AIzaSyDDdoYDg1prAjzexBDi8tIZ9E2bNOboauo&part=snippet,id&maxResults=15&channelId='. $video->post_content), true);
		// return '<a href="http://youtube.com/watch?v=' . $json["items"][0]["id"]["videoId"] .'"> hello</a>';
		return view('galerie.videos', compact("videos"));
	}




}
