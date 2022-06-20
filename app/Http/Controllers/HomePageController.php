<?php

namespace App\Http\Controllers;

use App\Models\HomePage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class HomePageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $home_path;
    private $welcome_path;
    private $direction_path;
    private $background_path;
    
    public function __construct()
    {
        $this->middleware('auth');
        $this->home_path   = public_path('/images/home');
        $this->welcome_path   = public_path('/images/home/welcome');
        $this->direction_path   = public_path('/images/home/direction');
        $this->background_path   = public_path('/images/home/background');
        
    }



    public function index()
    {
        $homesettings = HomePage::first();
        return view('backend.home.index',compact('homesettings'));
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
            'welcome_heading'          => $request->input('welcome_heading'),
            'welcome_subheading'       => $request->input('welcome_subheading'),
            'welcome_description'      => $request->input('welcome_description'),
            'welcome_side_image'       => $request->input('welcome_side_image'),
            'created_by'                => Auth::user()->id,
        ];

        if (!empty($request->file('welcome_image'))){

            if (!is_dir($this->home_path)) {
                mkdir($this->home_path, 0777);
            }
            if (!is_dir($this->welcome_path)) {
                mkdir($this->welcome_path, 0777);
            }

            $path    = base_path().'/public/images/home/welcome/';
            $image   = $request->file('welcome_image');
            $name1   = uniqid().'_welcome_'.$image->getClientOriginalName();
            $moved          = Image::make($image->getRealPath())->fit(820, 825)->orientate()->save($path.$name1);
            if ($moved){
                $data['welcome_image']= $name1;
            }
        }


        $theme = HomePage::create($data);
        if($theme){
            Session::flash('success','Welcome section info saved!');
        }
        else{
            Session::flash('error','Could not be saved at the moment !');
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
        //
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
        $update_theme                           =  HomePage::find($id);
        $update_theme->welcome_heading             =  $request->input('welcome_heading');
        $update_theme->welcome_subheading             =  $request->input('welcome_subheading');
        $update_theme->welcome_description             =  $request->input('welcome_description');
        $update_theme->welcome_side_image             =  $request->input('welcome_side_image');
        $update_theme->updated_by               =  Auth::user()->id;
       
        $oldimage                       = $update_theme->welcome_image;

        if (!empty($request->file('welcome_image'))){
            $path    = base_path().'/public/images/home/welcome/';
            $image = $request->file('welcome_image');
            $name1 = uniqid().'_welcome_'.$image->getClientOriginalName();
            $moved          = Image::make($image->getRealPath())->fit(820, 825)->orientate()->save($path.$name1);

            if ($moved){
                $update_theme->welcome_image= $name1;
                if (!empty($oldimage) && file_exists(public_path().'/images/home/welcome/'.$oldimage)){
                    @unlink(public_path().'/images/home/welcome/'.$oldimage);
                }
            }

        }

        $status=$update_theme->update();

        if($status){
            Session::flash('success','Welcome Section Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Welcome Section could not be Updated');
        }


        return redirect()->back();
    }


    public function direction(Request $request, $id)
    {
        $update_theme                                   =  HomePage::find($id);
        $update_theme->direction_heading                =  $request->input('direction_heading');
        $update_theme->direction_description            =  $request->input('direction_description');
        $update_theme->direction_list_heading           =  $request->input('direction_list_heading');
        $update_theme->direction_list_description       =  $request->input('direction_list_description');
        $update_theme->direction_displaying_side_image  =  $request->input('direction_displaying_side_image');
        $update_theme->direction_container_color        =  $request->input('direction_container_color');
        $update_theme->updated_by                       =  Auth::user()->id;
        $oldimage                                       = $update_theme->direction_list_image;

        if (!is_dir($this->direction_path)) {
            mkdir($this->direction_path, 0777);
        }

        if (!empty($request->file('direction_list_image'))){
            $path    = base_path().'/public/images/home/direction/';
            $image = $request->file('direction_list_image');
            $name1 = uniqid().'_direction_'.$image->getClientOriginalName();
            $moved          = Image::make($image->getRealPath())->fit(725, 810)->orientate()->save($path.$name1);

            if ($moved){
                $update_theme->direction_list_image= $name1;
                if (!empty($oldimage) && file_exists(public_path().'/images/home/direction/'.$oldimage)){
                    @unlink(public_path().'/images/home/direction/'.$oldimage);
                }
            }

        }

        $status=$update_theme->update();

        if($status){
            Session::flash('success','Simple Section Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Simple  Section could not be Updated');
        }


        return redirect()->back();
    }


    public function background(Request $request, $id)
    {
        $update_theme                                   =  HomePage::find($id);
        $update_theme->background_heading                =  $request->input('background_heading');
        $update_theme->background_subheading            =  $request->input('background_subheading');
        $update_theme->background_description           =  $request->input('background_description');
       
        $update_theme->updated_by                       =  Auth::user()->id;
        $backgroundoldimage                             = $update_theme->background_image;
        $sideoldimage                                   = $update_theme->background_side_image;

        if (!is_dir($this->background_path)) {
            mkdir($this->background_path, 0777);
        }

        if (!empty($request->file('background_image'))){
            $path    = base_path().'/public/images/home/background/';
            $image = $request->file('background_image');
            $name1 = uniqid().'_background_image_'.$image->getClientOriginalName();
            $moved          = Image::make($image->getRealPath())->fit(1920, 1080)->orientate()->save($path.$name1);

            if ($moved){
                $update_theme->background_image= $name1;
                if (!empty($backgroundoldimage) && file_exists(public_path().'/images/home/background/'.$backgroundoldimage)){
                    @unlink(public_path().'/images/home/background/'.$backgroundoldimage);
                }
            }

        }


        if (!empty($request->file('background_side_image'))){
            $sidepath    = base_path().'/public/images/home/background/';
            $sideimage = $request->file('background_side_image');
            $name = uniqid().'_background_side_image_'.$sideimage->getClientOriginalName();
            $move          = Image::make($sideimage->getRealPath())->fit(700,815)->orientate()->save($sidepath.$name);

            if ($move){
                $update_theme->background_side_image= $name;
                if (!empty($sideoldimage) && file_exists(public_path().'/images/home/background/'.$sideoldimage)){
                    @unlink(public_path().'/images/home/background/'.$sideoldimage);
                }
            }

        }

        $status=$update_theme->update();

        if($status){
            Session::flash('success','Background Section Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Background Section could not be Updated');
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
        //
    }
}
