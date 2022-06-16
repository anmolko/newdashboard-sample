<?php

namespace App\Http\Controllers;

use App\Models\ApplyJob;
use App\Models\Career;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;

class CareerController extends Controller
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
        $careers_active    = Career::where('status','active')->get();
        $careers           = Career::all();
        $careers_inactive  = Career::where('status','inactive')->get();
        return view('backend.career.index',compact('careers','careers_active','careers_inactive'));
    }

    public function responseIndex()
    {
        $applied_job           = ApplyJob::with('career')->get();
        $career_response       = '';
        return view('backend.career.response.index',compact('applied_job','career_response'));
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

       $enddate = ($request->input('end_date') !== null) ? Carbon::parse($request->input('end_date'))->format('Y-m-d'):null;
        $data=[
            'name'              => $request->input('name'),
            'slug'              => $request->input('slug'),
            'position'          => $request->input('position'),
            'description'       => $request->input('description'),
            'type'              => $request->input('type'),
            'start_date'        => $request->input('start_date'),
            'end_date'          => $enddate,
            'salary'            => $request->input('salary'),
            'status'            => $request->input('status'),
            'meta_title'        => $request->input('meta_title'),
            'meta_tags'         => $request->input('meta_tags'),
            'meta_description'  => $request->input('meta_description'),
            'created_by'        => Auth::user()->id,
        ];

        if(!empty($request->file('feature_image'))){
            $image          = $request->file('feature_image');
            $name           = uniqid().'_career_feature_'.$image->getClientOriginalName();
            $career_path    = public_path('/images/career');

            if (!is_dir($career_path)) {
                mkdir($career_path, 0777);
            }

            $path           = base_path().'/public/images/career/';
            $moved          = Image::make($image->getRealPath())->orientate()->save($path.$name);

            if ($moved){
                $data['feature_image']=$name;
            }
        }
        $service = Career::create($data);
        if($service){
            Session::flash('success','Career details was created successfully !');
        }
        else{
            Session::flash('error','Career details could not be created at the moment !');
        }

        return redirect()->route('career.index');

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
        $edit     = Career::find($id);
        $enddate  = Carbon::parse($edit->end_date)->isoFormat('DD MMM, Y');
        return response()->json(['edit'=>$edit,'date'=>$enddate]);
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
        $career                      =  Career::find($id);
        $career->name                =  $request->input('name');
        $career->slug                =  $request->input('slug');
        $career->position            =  $request->input('position');
        $career->description         =  $request->input('description');
        $career->start_date          =  $request->input('start_date');
        $career->type                =  $request->input('type');
        $career->end_date            =  $request->input('end_date');
        $career->salary              =  $request->input('salary');
        $career->status              =  $request->input('status');
        $career->meta_title          =  $request->input('meta_title');
        $career->meta_tags           =  $request->input('meta_tags');
        $career->meta_description    =  $request->input('meta_description');
        $career->updated_by          =  Auth::user()->id;
        $oldimage                    =  $career->feature_image;

        if (!empty($request->file('feature_image'))){
            $image       = $request->file('feature_image');
            $name1       = uniqid().'_career_feature_'.$image->getClientOriginalName();
            $path        = base_path().'/public/images/career/';
            $moved       = Image::make($image->getRealPath())->orientate()->save($path.$name1);

            if ($moved){
                $career->feature_image= $name1;
                if (!empty($oldimage) && file_exists(public_path().'/images/career/'.$oldimage)){
                    @unlink(public_path().'/images/career/'.$oldimage);
                }
            }
        }

        $status = $career->update();
        if($status){
            Session::flash('success','Career details Post was updated successfully');
        }
        else{
            Session::flash('error','Something Went Wrong.Career details could not be updated. Try again later !');
        }
        return redirect()->route('career.index');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete      = Career::find($id);
        $ids      = $delete->id;

        if (!empty($delete->feature_image) && file_exists(public_path().'/images/career/'.$delete->feature_image)){
            @unlink(public_path().'/images/career/'.$delete->feature_image);
        }
        $remove       = $delete->delete();
        if($remove){
            $status ='success';
            return response()->json(['status'=>$status,'message'=>'Career details has been removed! ','id'=>$ids]);        }
        else{
            $status ='error';
            return response()->json(['status'=>$status,'message'=>'Career details could not be removed. Try Again later !']);
        }
    }

    public function responseDestroy($id)
    {
        $delete      = ApplyJob::find($id);
        $cv          = $delete->attachcv;
        if (!empty($cv) && file_exists(public_path().'/images/career/'.$cv)){
            @unlink(public_path().'/images/career/'.$cv);
        }
        $remove      = $delete->delete();
        if($remove){
            $status ='success';
            return response()->json(['status'=>$status,'message'=>'Career Response details has been removed! ']);        }
        else{
            $status ='error';
            return response()->json(['status'=>$status,'message'=>'Career Response details could not be removed. Try Again later !']);
        }
    }

    public function updateStatus(Request $request, $id){
        $career          = Career::find($id);
        $career->status  = $request->status;
        $status          = $career->update();
        $new_status      = $career->status;
        if($status){
            $status ='success';
            return response()->json(['status'=>$status,'new_status'=>$new_status,'id'=>$id]);
        }
        else{
            $status ='error';
            return response()->json(['status'=>$status,'new_status'=>$new_status,'id'=>$id]);
        }
        return response()->json($confirmed);

    }
}
