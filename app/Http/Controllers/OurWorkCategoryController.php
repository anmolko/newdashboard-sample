<?php

namespace App\Http\Controllers;

use App\Models\OurWorkCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OurWorkCategoryController extends Controller
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
        //
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
        $slug  = OurWorkCategory::where('slug',$request->input('slug'))->first();
        if ($slug !== null) {
            $status ='slug duplicate';
            return response()->json(['status'=>$status,'message'=>'This category title is already in use. Try something different.']);
        }else{
            $category         =  OurWorkCategory::create([
                'name'        => $request->input('name'),
                'slug'        => $request->input('slug'),
                'created_by'  => Auth::user()->id,
            ]);
            if($category){
                $category    = OurWorkCategory::latest()->first();
                $status ='success';
                return response()->json(['status'=>$status,'message'=>'New work category added to list.','category'=>$category]);
            }
            else{
                $status ='error';
                return response()->json(['status'=>$status,'message'=>'Could not create work category at the moment. Try Again later !']);
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
        $edit     = OurWorkCategory::find($id);
        return response()->json($edit);
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
        $category               = OurWorkCategory::find($id);
        $category->name         = $request->input('name');
        $category->slug         = $request->input('slug');
        $category->updated_by   = Auth::user()->id;
        $status                 = $category->update();

        if($status){
            Session::flash('success','Work category has been updated');
        }
        else{
            Session::flash('error','Something Went Wrong. Work Category could not be Updated');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete          = OurWorkCategory::find($id);
        $rid             = $delete->id;
        $check           = $delete->works()->get();
        $count           = $delete->count();

        if ($check->count() > 0) {
            $status ='error';
            return response()->json(['status'=>$status,'id'=>$rid,'count'=>$count,'message'=>'Work Category is currently in use with different work section. Try removing them first !']);
        }else{
            $delete->delete();
            $status ='success';
            return response()->json(['status'=>$status,'id'=>$rid,'count'=>$count,'message'=>'Work category info was removed!']);

        }
    }
}
