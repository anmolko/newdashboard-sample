<?php

namespace App\Http\Controllers;

use App\Models\CoreValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class CoreValuesController extends Controller
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
        $values        = CoreValue::all();
        return view('backend.values.index',compact('values'));
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
        $data=[
            'heading'                => $request->input('heading'),
            'description'            => $request->input('description'),
            'created_by'          => Auth::user()->id,
        ];
        if(!empty($request->file('image'))){
            $image        = $request->file('image');
            $name         = uniqid().'_'.$image->getClientOriginalName();
            $path         = base_path().'/public/images/uploads/values/';
            $moved        = Image::make($image->getRealPath())->resize(128, 128)->orientate()->save($path.$name);
            if ($moved){
                $data['image']= $name;
            }
        }
        $clients = CoreValue::create($data);
        if($clients){
            Session::flash('success','Core value added ');
        }
        else{
            Session::flash('error','Something went wrong. Core value cannot be created');
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
        $edit           = CoreValue::find($id);
        return response()->json(["edit"=>$edit]);
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
        $value                     =  CoreValue::find($id);
        $value->heading            =  $request->input('heading');
        $value->description        =  $request->input('description');
        $oldimage                  = $value->image;

        if (!empty($request->file('image'))){
            $image                = $request->file('image');
            $name                 = uniqid().'_'.$image->getClientOriginalName();
            $path                 = base_path().'/public/images/uploads/values/';
            $moved                = Image::make($image->getRealPath())->resize(128, 128)->orientate()->save($path.$name);
            if ($moved){
                $value->image = $name;
                if (!empty($oldimage) && file_exists(public_path().'/images/uploads/values/'.$oldimage)){
                    @unlink(public_path().'/images/uploads/values/'.$oldimage);
                }
            }
        }
        $status = $value->update();
        if($status){
            Session::flash('success','Core Value was updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Core value could not be Updated');
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
        $delete       = CoreValue::find($id);
        $rid          = $delete->id;
        if (!empty($delete->image) && file_exists(public_path().'/images/uploads/values/'.$delete->image)){
            @unlink(public_path().'/images/uploads/values/'.$delete->image);
        }
        $delete->delete();
        return '#val_'.$rid;
    }
}
