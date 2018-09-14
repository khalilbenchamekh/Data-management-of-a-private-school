<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\UmdPost;
use App\Models\UmdTerm;
use App\Models\UmdTermTaxonomy;
use App\Models\UmdTermRelationship;
use Auth;
use App\User;

class AdminPressController extends Controller
{



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = UmdPost::where('post_type', 'press')->where('post_author', Auth::user()->id)->get();
		return view('admin.press.articles', compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$categories = UmdTermTaxonomy::whereRaw('taxonomy = \'category\' or taxonomy = \'group\'')->get();

		$cats = [];
		foreach ($categories as $category) {
			$cats[$category->term_taxonomy_id] = $category->UmdTerm->name;
		}
        return view('admin.press.new', ['cats' => $cats]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$post_type = "press";

		$post = new UmdPost();
		$post->post_title = $request->input('title');
		$post->post_slug = str_replace(" ", "-", $request->input('title'));
		$post->post_content = $request->input('content');
		$post->post_author = Auth::user()->id;
		if( $request->hasFile('attachment') ) {
	        $file = $request->file('attachment');
			$file->move(public_path() . "/uploads" , $file->getClientOriginalName());
	        $post->post_attachment = $file->getClientOriginalName();
            
	    }
		$post->post_excerpt = mb_substr(strip_tags($request->input('content')), 0, 150) . " ...";
		$post->post_type = $post_type;
		$post->post_status = $request->input('statut');
		$post->save();

		$termRel = new UmdTermRelationship();
		$termRel->object_id = $post->ID;
		$termRel->term_taxonomy_id = $request->input('category');
		$termRel->parent = UmdTermTaxonomy::where('term_taxonomy_id', $request->input('category'))->first()->parent;
		$termRel->save();


		return redirect(route('admin.press.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

		$post = UmdPost::find($id);
		return redirect($post->UmdTermTaxonomy[0]->UmdTermParent->slug .'/' . $post->UmdTermTaxonomy[0]->UmdTerm->slug . '/' . $post->post_slug);
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
		$categories = UmdTermTaxonomy::whereRaw('taxonomy = \'category\' or taxonomy = \'group\'')->get();

		$cats = [];
		foreach ($categories as $category) {
			$cats[$category->term_taxonomy_id] = $category->UmdTerm->name;
		}
		return view('admin.press.article', ['post' => $post, 'cats' => $cats]);
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
		$post->post_slug = str_replace(" ", "-", $request->input('title'));
		$post->post_content = $request->input('content');
		if( $request->hasFile('attachment') ) {
	        $file = $request->file('attachment');
			$file->move(public_path() . "/uploads" , $file->getClientOriginalName());
			// dd($file->getClientOriginalName());
	        $post->post_attachment = $file->getClientOriginalName();
	    }
		$post->post_excerpt = mb_substr(strip_tags($request->input('content')), 0, 150) . " ...";
		$post->post_status = $request->input('statut');
		$post->save();


		$termTax = UmdTermRelationship::where('object_id', $id)->first();
		$termTax->term_taxonomy_id = $request->input('category');
		$termRel->parent = UmdTermTaxonomy::where('term_taxonomy_id', $request->input('category'))->first()->parent;
		$termTax->save();
		return redirect(route('admin.press.index'));
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
		return redirect(route('admin.press.index'));
    }
}
