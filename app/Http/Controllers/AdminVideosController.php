<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\UmdPost;
use Auth;

class AdminVideosController extends Controller
{

	public function __construct(){
		$this->middleware('manager');
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$events = UmdPost::where('post_type', 'video')->get();
		return view('admin.videos.videos', ['events' => $events]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.videos.new');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$post = new UmdPost();
		$post->post_title = $request->input('title');
		$post->post_content = $request->input('content');
		$post->post_author = Auth::user()->id;
		$post->post_date = '';
		if( $request->hasFile('attachment') ) {
	        $file = $request->file('attachment');
			$file->move(public_path() . "/uploads" , $file->getClientOriginalName());
	        $post->post_attachment = $file->getClientOriginalName();
	    }else{
           $post->post_attachment = 'photos.png'; 
        }
		$post->post_type = 'video';

        if( $request->input('statut') != null)
		    $post->post_status = $request->input('statut');
        else 
            $post->post_status = 0;

		$post->save();
		return redirect(route('admin.videos.index'));
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
		$post = UmdPost::find($id);
		return view('admin.videos.video', ['post' => $post]);
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
		$post = UmdPost::FindOrFail($id);
		$post->post_title = $request->input('title');
		$post->post_content = $request->input('content');
		$post->post_date = $request->input('date');
		if( $request->hasFile('attachment') ) {
	        $file = $request->file('attachment');
			$file->move(public_path() . "/uploads" , $file->getClientOriginalName());
			// dd($file->getClientOriginalName());
	        $post->post_attachment = $file->getClientOriginalName();
	    }
		$post->post_status = $request->input('statut');
		$post->save();
		return redirect(route('admin.videos.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$post = UmdPost::FindOrFail($id);
		$post->delete();
		return redirect(route('admin.videos.index'));
    }
}
