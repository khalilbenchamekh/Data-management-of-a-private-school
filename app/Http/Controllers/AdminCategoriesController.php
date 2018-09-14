<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\UmdTermTaxonomy;
use App\Models\UmdTerm;
use App\Models\UmdTermRelationship;

class AdminCategoriesController extends Controller
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
		$categories = UmdTermTaxonomy::where('taxonomy', 'category')->get();
		$terms = UmdTerm::get();

		return view('admin.categories.categories', ['categories' => $categories, 'terms' => $terms]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$categories = UmdTermTaxonomy::whereRaw('taxonomy = \'category\' or taxonomy = \'category-main\'')->get();

		$cats = [];
		foreach ($categories as $category) {
			$cats[$category->term_id] = $category->UmdTerm->name;
		}

		return view('admin.categories.new', ['cats' => $cats]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $categoryTerm = new UmdTerm();
		$categoryTerm->name = $request->input('title');
		$categoryTerm->slug = str_replace(" ", "-", $request->input('title'));
		$categoryTerm->save();
		$categoryTax = new UmdTermTaxonomy();
		$categoryTax->term_id = $categoryTerm->term_id;
		$categoryTax->parent = $request->input('parent');
		$categoryTax->taxonomy = 'category';
		$categoryTax->save();
		return redirect(route('admin.categories.index'));
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
		$cat = UmdTermTaxonomy::find($id);
		// dd($category->UmdTerm->name);
		$categories = UmdTermTaxonomy::whereRaw('taxonomy = \'category\' or taxonomy = \'category-main\'')->get();
		$cats = [];
		foreach ($categories as $category) {
			$cats[$category->term_id] = $category->UmdTerm->name;
		}
		return view('admin.categories.category', ['cats' => $cats, 'cat' => $cat]);
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
		// dd($id);
		$categoryTerm = UmdTerm::FindOrFail($id)->first();
		$categoryTerm->name = $request->input('title');
		$categoryTerm->slug = str_replace(" ", "-", $request->input('title'));
		$categoryTerm->save();
		$categoryTax = UmdTermTaxonomy::where('term_id', $id)->first();
		$categoryTax->parent = $request->input('parent');
		$categoryTax->save();
		return redirect(route('admin.categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

		$categoryTax = UmdTermTaxonomy::find($id);
		$termid = $categoryTax->term_id;
		$categoryTax->delete();
		$categoryTerm = UmdTerm::find($termid)->delete();

		$posts = UmdTermRelationship::where('term_taxonomy_id', $id)->get();
		foreach ($posts as $post) {
			$post->UmdComments()->delete;
			$terms = UmdTermRelationship::where('object_id', $post->ID)->delete();
			$post->delete();
		}
		return redirect(route('admin.categories.index'));
		
    }
}
