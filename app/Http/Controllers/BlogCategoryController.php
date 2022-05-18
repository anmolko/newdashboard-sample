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
        return view('backend.blog.category.index',compact('categories'));
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

        $slug  = BlogCategory::where('slug',$request->input('slug'))->first();
        if ($slug !== null) {
            $status ='slug duplicate';
            return response()->json(['status'=>$status,'message'=>'This category title is already in use. Try something different.']);
        }else{
            $category         =  BlogCategory::create([
                'name'        => $request->input('name'),
                'slug'        => $request->input('slug'),
                'created_by'  => Auth::user()->id,
            ]);
            if($category){
                $category = BlogCategory::latest()->first();
                $status ='success';
                return response()->json(['status'=>$status,'message'=>'New blog category added to list.','category'=>$category]);
            }
            else{
                $status ='error';
                return response()->json(['status'=>$status,'message'=>'Could not create new blog category at the moment. Try Again later !']);
            }
        }


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
            $status ='success';
            return response()->json(['status'=>$status,'message'=>'Blog category has been updated.']);
        }
        else{
            $status ='error';
            return response()->json(['status'=>$status,'message'=>'Something Went Wrong.Blog Category could not be Updated !']);
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
            $status ='error';
            return response()->json(['status'=>$status,'id'=>$rid,'message'=>'Blog Category info could not be removed at the moment. Try Again later !']);
        }else{
            $deletecategory->delete();
            $status ='success';
            return response()->json(['status'=>$status,'id'=>$rid,'message'=>'Blog category info was removed!']);
               
        }
    }
}
