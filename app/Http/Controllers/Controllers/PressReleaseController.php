<?php

namespace App\Http\Controllers;

use App\Http\Requests\PressReleaseUpdateRequest;
use App\Models\PressRelease;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class PressReleaseController extends Controller
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
        $press_release = PressRelease::all();
        return view('backend.press_release.index',compact('press_release'));
    }

    /**
     * Show the form for creating a new resource.s
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
        $slug = PressRelease::where('slug', $request->input('slug'))->first();
        if ($slug !== null) {
            return 'duplicate';
        }else {
            $data = [
                'title' => $request->input('title'),
                'slug' => $request->input('slug'),
                'description' => $request->input('description'),
                'status' => $request->input('status'),
                'created_by' => Auth::user()->id,
            ];

            if (!empty($request->file('image'))) {
                $image = $request->file('image');
                $originalname = str_replace(' ', '_', $image->getClientOriginalName());
                $name = uniqid() . '_press_release_' . $originalname;
                $path = base_path() . '/public/images/uploads/press_releases/';
                $thumb_path     = base_path().'/public/images/uploads/press_releases/thumb/';
                $thumb_name     = 'thumb_'.$name;
                $moved = Image::make($image->getRealPath())->fit(1280, 720)->orientate()->save($path . $name);
                $thumb          = Image::make($image->getRealPath())->fit(80,80)->orientate()->save($thumb_path.$thumb_name);
                if ($moved) {
                    $data['image'] = $name;
                }
            }

            $blog = PressRelease::create($data);
            if ($blog) {
                Session::flash('success', 'Press Release was created successfully');
            } else {
                Session::flash('error', 'Press Release was could not be created');
            }
            return route('press-release.index');
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
        $edit   = PressRelease::find($id);
        return response()->json($edit);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PressReleaseUpdateRequest $request, $id)
    {
        $press                      =  PressRelease::find($id);
        $press->title               =  $request->input('title');
        $press->slug                =  $request->input('slug');
        $press->description         =  $request->input('description');
        $press->status              =  $request->input('status');
        $press->updated_by          =  Auth::user()->id;
        $oldimage                   =  $press->image;

        if (!empty($request->file('image'))){
            $image          = $request->file('image');
            $originalname   = str_replace(' ','_',$image->getClientOriginalName());
            $name1           = uniqid().'_press_release_'.$originalname;
            $thumb_path     = base_path().'/public/images/uploads/press_releases/thumb/';
            $thumb_name     = 'thumb_'.$name1;
            $path        = base_path().'/public/images/uploads/press_releases/';
            $moved         = Image::make($image->getRealPath())->fit(1280,720)->orientate()->save($path.$name1);
            $thumb          = Image::make($image->getRealPath())->fit(80,80)->orientate()->save($thumb_path.$thumb_name);


            if ($moved){
                $press->image= $name1;
                if (!empty($oldimage) && file_exists(public_path().'/images/uploads/press_releases/'.$oldimage)){
                    @unlink(public_path().'/images/uploads/press_releases/'.$oldimage);
                }
            }
        }
        $status = $press->update();
        if($status){
            Session::flash('success','Press Release was updated successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Press Release could not be Updated');
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
        $delete          = PressRelease::find($id);
        $rid             = $delete->id;

        if (!empty($delete->image) && file_exists(public_path().'/images/uploads/press_releases/'.$delete->image)){
            @unlink(public_path().'/images/uploads/press_releases/'.$delete->image);
        }
        $delete->delete();
        return '#press_'.$rid;
    }

    public function updateStatus(Request $request, $id){
        $press          = PressRelease::find($id);
        $press->status  = $request->status;
        $status         = $press->update();
        if($status){
            $confirmed = "yes";
        }
        else{
            $confirmed = "no";
        }
        return response()->json($confirmed);
    }
}
