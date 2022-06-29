<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $categories = BlogCategory::all();
        $blogs      = Blog::all();
        return view('backend.blog.category.index',compact('categories','blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category         =  BlogCategory::create([
            'name'        => $request->input('name'),
            'slug'        => $request->input('slug'),
            'created_by'  => Auth::user()->id,
        ]);
        if($category){
            Session::flash('success','Blog Category Created Successfully');
        }
        else{
            Session::flash('error','Blog Category Creation Failed');
        }

        return redirect()->back();
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
        $editcategory     = BlogCategory::find($id);
        return response()->json($editcategory);
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
        $category               = BlogCategory::find($id);
        $category->name         = $request->input('name');
        $category->slug         = $request->input('slug');
        $category->updated_by   = Auth::user()->id;
        $status                 = $category->update();
        if($status){
            Session::flash('success','Blog Category Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong.Blog Category could not be Updated');
        }
        return redirect()->route('blogcategory.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletecategory  = BlogCategory::find($id);
        $rid             = $deletecategory->id;
        $checkblog       = $deletecategory->blogs()->get();
        if ($checkblog->count() > 0) {
            return 0;
        }else{
            $deletecategory->delete();
        }
        return '#blog_category'.$rid;
    }
}
