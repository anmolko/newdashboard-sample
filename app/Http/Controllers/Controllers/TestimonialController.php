<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class TestimonialController extends Controller
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
        $testimonials = Testimonial::all();
        return view('backend.testimonials.index',compact('testimonials'));
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
            'title'             => $request->input('title'),
            'subtitle'          => $request->input('subtitle'),
            'testimonial'       => $request->input('testimonial'),
            'created_by'        => Auth::user()->id,
        ];

        if(!empty($request->file('image'))){
            $image        = $request->file('image');
            $name         = uniqid().'_'.$image->getClientOriginalName();
            $path         = base_path().'/public/images/uploads/testimonials/';
            $moved        = Image::make($image->getRealPath())->resize(80, 80)->orientate()->save($path.$name);
            if ($moved){
                $data['image']= $name;
            }
        }

        $testimonial = Testimonial::create($data);
        if($testimonial){
            Session::flash('success','Testimonial added Successfully');
        }
        else{
            Session::flash('error','Something went wrong. Testimonial could not be added');
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
        $edit   = Testimonial::find($id);
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
        $testimonial                    =  Testimonial::find($id);
        $testimonial->title             =  $request->input('title');
        $testimonial->subtitle          =  $request->input('subtitle');
        $testimonial->testimonial       =  $request->input('testimonial');
        $oldimage                       = $testimonial->image;

        if (!empty($request->file('image'))){
            $image                = $request->file('image');
            $name                 = uniqid().'_'.$image->getClientOriginalName();
            $path                 = base_path().'/public/images/uploads/testimonials/';
            $moved                = Image::make($image->getRealPath())->resize(80, 80)->orientate()->save($path.$name);
            if ($moved){
                $testimonial->image = $name;
                if (!empty($oldimage) && file_exists(public_path().'/images/uploads/testimonials/'.$oldimage)){
                    @unlink(public_path().'/images/uploads/testimonials/'.$oldimage);
                }
            }
        }

        $status = $testimonial->update();
        if($status){
            Session::flash('success','Testimonial was updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Testimonial could not be Updated');
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
        $delete      = Testimonial::find($id);
        $rid         = $delete->id;
        if (!empty($delete->image) && file_exists(public_path().'/images/uploads/testimonials/'.$delete->image)){
            @unlink(public_path().'/images/uploads/testimonials/'.$delete->image);
        }
        $delete->delete();
        return '#testimonials_'.$rid;
    }
}
