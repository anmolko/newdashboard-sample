<?php

namespace App\Http\Controllers;

use App\Models\OurWork;
use App\Models\OurWorkCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class OurWorkController extends Controller
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
        $works      = OurWork::with('category')->get();
        $categories = OurWorkCategory::orderBy('id','DESC')->get();
        return view('backend.work.index',compact('works','categories'));
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
            'work_category_id'  => $request->input('work_category_id'),
            'created_by'        => Auth::user()->id,
        ];

        if(!empty($request->file('image'))){
            $image          = $request->file('image');
            $name           = uniqid().'_works_'.$image->getClientOriginalName();
            $work_path      = public_path('/images/work');

            if (!is_dir($work_path)) {
                mkdir($work_path, 0777);
            }
            $path           = base_path().'/public/images/work/';
            $moved          = Image::make($image->getRealPath())->orientate()->save($path.$name);

            if ($moved){
                $data['image']=$name;
            }
        }
        $service = OurWork::create($data);
        if($service){
            Session::flash('success','Work was created successfully !');
        }
        else{
            Session::flash('error','Work could not be created at the moment !');
        }

        return redirect()->route('our-work.index');
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
        $edit      = OurWork::find($id);
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
        $work                         = OurWork::find($id);
        $work->title                  = $request->input('title');
        $work->work_category_id       = $request->input('work_category_id');
        $oldimage                     = $work->image;
        $path                         = base_path().'/public/images/work/';

        if (!empty($request->file('image'))){
            $image       = $request->file('image');
            $name1       = uniqid().'_works_'.$image->getClientOriginalName();
            $moved       = Image::make($image->getRealPath())->orientate()->save($path.$name1);

            if ($moved){
                $work->image= $name1;
                if (!empty($oldimage) && file_exists(public_path().'/images/work/'.$oldimage)){
                    @unlink(public_path().'/images/work/'.$oldimage);
                }
            }
        }

        $status = $work->update();
        if($status){
            Session::flash('success','Work was updated successfully !');
        }
        else{
            Session::flash('error','Something Went Wrong. Work could not be updated at the moment !');
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
        $delete          = OurWork::find($id);
        $rid             = $delete->id;
        $delete->delete();
        $status ='success';
        return response()->json(['status'=>$status,'id'=>$rid,'message'=>'Work and its details was removed!']);

    }
}
