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
    public function index()
    {
        $testimonials           = Testimonial::all();
        return view('backend.testimonial.index',compact('testimonials'));
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
            'name'              => $request->input('name'),
            'position'          => $request->input('position'),
            'rating'            => $request->input('rating'),
            'description'       => $request->input('description'),
            'created_by'        => Auth::user()->id,
        ];

        if(!empty($request->file('image'))){
            $image          = $request->file('image');
            $name           = uniqid().'_testimonial_'.$image->getClientOriginalName();
            $blog_path      = public_path('/images/testimonial');

            if (!is_dir($blog_path)) {
                mkdir($blog_path, 0777);
            }
            $path           = base_path().'/public/images/testimonial/';
            $moved          = Image::make($image->getRealPath())->orientate()->save($path.$name);

            if ($moved){
                $data['image']=$name;
            }
        }
        $testimonial = Testimonial::create($data);
        if($testimonial){
            Session::flash('success','Testimonial was created successfully !');
        }
        else{
            Session::flash('error','Testimonial could not be created at the moment !');
        }

        return redirect()->route('testimonials.index');
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
        $edit    = Testimonial::find($id);
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
        $testimonial                      =  Testimonial::find($id);
        $testimonial->name                =  $testimonial->input('name');
        $testimonial->position            =  $testimonial->input('position');
        $testimonial->rating              =  $testimonial->input('edit_rating');
        $testimonial->description         =  $testimonial->input('description');
        $oldimage                            =  $testimonial->image;

        if (!empty($request->file('image'))){
            $image       = $request->file('image');
            $path        = base_path().'/public/images/testimonial/';
            $name1       = uniqid().'_testimonial_'.$image->getClientOriginalName();
            $moved       = Image::make($image->getRealPath())->orientate()->save($path.$name1);

            if ($moved){
                $testimonial->image= $name1;
                if (!empty($oldimage) && file_exists(public_path().'/images/testimonial/'.$oldimage)){
                    @unlink(public_path().'/images/testimonial/'.$oldimage);
                }
            }
        }
        $status = $testimonial->update();
        if($status){
            Session::flash('success','Testimonial was updated successfully !');
        }
        else{
            Session::flash('error','Something Went Wrong. Testimonial could not be updated at the moment !');
        }
        return redirect()->route('services.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
