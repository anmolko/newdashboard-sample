<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class JobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pendings           = JobApplication::where('status','pending')->get();
        $applied            = JobApplication::where('status','applied')->get();
        $processing         = JobApplication::where('status','processing')->get();
        $selected           = JobApplication::where('status','selected')->get();
        $cancelled          = JobApplication::where('status','cancelled')->get();
        return view('backend.job_application.index',compact('pendings','applied','processing','selected','cancelled'));
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
            'job_id'              => $request->input('job_id'),
            'name'                => $request->input('name'),
            'email'               => $request->input('email'),
            'number'              => $request->input('number'),
            'current_address'     => $request->input('current_address'),
            'permanent_address'   => $request->input('permanent_address'),
            'message'             => $request->input('message'),
            'status'              => 'pending',
        ];

        if(!empty($request->file('cv'))){
            $image        = $request->file('cv');
            $name         = uniqid().'_cv_'.$image->getClientOriginalName();
            $path         = base_path().'/public/images/uploads/job_applications/cv/';
            $moved        = Image::make($image->getRealPath())->orientate()->save($path.$name);
            if ($moved){
                $data['cv']= $name;
            }
        }

        if(!empty($request->file('latest_photo'))){
            $image        = $request->file('latest_photo');
            $name         = uniqid().'_photo_'.$image->getClientOriginalName();
            $path         = base_path().'/public/images/uploads/job_applications/photo/';
            $moved        = Image::make($image->getRealPath())->orientate()->save($path.$name);
            if ($moved){
                $data['latest_photo']= $name;
            }
        }

        if(!empty($request->file('passport'))){
            $image        = $request->file('passport');
            $name         = uniqid().'_passport_'.$image->getClientOriginalName();
            $path         = base_path().'/public/images/uploads/job_applications/passport/';
            $moved        = Image::make($image->getRealPath())->orientate()->save($path.$name);
            if ($moved){
                $data['passport']= $name;
            }
        }

        $application = JobApplication::create($data);
        if($application){
             Session::flash('success','Success ! Your Application has been submitted. We will reach out to you soon. Thank you !');
        } else{
            Session::flash('error','Something went wrong. Job Application cannot be Submitted. Try Again');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete       = JobApplication::find($id);
        $rid          = $delete->id;
        $cv           = $delete->cv;
        $photo        = $delete->latest_photo;
        $passport     = $delete->passport;
        if (!empty($cv) && file_exists(public_path().'/images/uploads/job_applications/cv/'.$cv)){
            @unlink(public_path().'/images/uploads/job_applications/cv/'.$cv);
        }
        if (!empty($photo) && file_exists(public_path().'/images/uploads/job_applications/photo/'.$photo)){
            @unlink(public_path().'/images/uploads/job_applications/photo/'.$photo);
        }
        if (!empty($passport) && file_exists(public_path().'/images/uploads/job_applications/passport/'.$passport)){
            @unlink(public_path().'/images/uploads/job_applications/passport/'.$passport);
        }
        $delete->delete();
        return '#application_'.$rid;
    }

    public function updateStatus(Request $request, $id){
        $application          = JobApplication::find($id);
        $application->status  = $request->status;
        $status               = $application->update();
        if($status){
            $confirmed = "yes";
        }
        else{
            $confirmed = "no";
        }
        return response()->json($confirmed);
    }
}
