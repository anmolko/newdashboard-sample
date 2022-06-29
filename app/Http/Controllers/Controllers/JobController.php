<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobCreateRequest;
use App\Http\Requests\JobUpdateRequest;
use App\Models\Client;
use App\Models\Job;
use App\Models\JobCategory;
use App\Models\ServiceCategory;
use Carbon\Carbon;
use CountryState;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;


class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $categories         = JobCategory::all();
        $jobs               = Job::with('category')->get();
        $countries          = CountryState::getCountries();
        $clients            = Client::all();
        $service_categories = ServiceCategory::all();
//        dd($jobs);
        return view('backend.job.index',compact('categories','jobs','countries','clients','service_categories'));
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
    public function store(JobCreateRequest $request)
    {
        $end     = Carbon::createFromFormat('d/m/Y', $request->end_date)->format('Y-m-d');
        $start   = Carbon::createFromFormat('d/m/Y', $request->start_date)->format('Y-m-d');
        $country = Client::find($request->input('client_id'))->country;
        $data=[
            'lt_number'            => $request->input('lt_number'),
            'country'              => $country,
            'job_category_id'      => $request->input('job_category_id'),
            'name'                 => $request->input('name'),
            'slug'                 => $request->input('slug'),
            'client_id'            => $request->input('client_id'),
            'required_number'      => $request->input('required_number'),
            'salary'               => $request->input('salary'),
            'min_qualification'    => $request->input('min_qualification'),
            'description'          => $request->input('description'),
            'start_date'           => $start,
            'end_date'             => $end,
            'status'               => $request->input('status'),
            'formlink'             => $request->input('formlink'),
            'created_by'           => Auth::user()->id,
        ];

        if(!empty($request->file('image'))){
            $image        = $request->file('image');
            $name         = uniqid().'_'.$image->getClientOriginalName();
            $path         = base_path().'/public/images/uploads/jobs/';
            $moved        = Image::make($image->getRealPath())->resize(1280, 720)->orientate()->save($path.$name);
            if ($moved){
                $data['image']= $name;
            }
        }

        $status = Job::create($data);
        if($status){
            Session::flash('success','Job details Created Successfully');
        }
        else{
            Session::flash('error','Job details Creation Failed');
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
        $edit           = Job::find($id);
        $countries      = CountryState::getCountries();
        $end            = Carbon::createFromFormat('Y-m-d', $edit->end_date)->format('d/m/Y');
        $start          = Carbon::createFromFormat('Y-m-d', $edit->start_date)->format('d/m/Y');
        $cat_name       = $edit->category->name;
//        dd($cat_name);
        return response()->json(["edit"=>$edit,"countries"=>$countries,"start"=>$start,"end"=>$end,"cat_name"=>$cat_name]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(JobUpdateRequest $request, $id)
    {

        $end     = Carbon::createFromFormat('d/m/Y', $request->end_date)->format('Y-m-d');
        $start   = Carbon::createFromFormat('d/m/Y', $request->start_date)->format('Y-m-d');
        $country = Client::find($request->input('client_id'))->country;

        $job                        = Job::find($id);
        $job->job_category_id       = $request->input('job_category_id');
        $job->name                  = $request->input('name');
        $job->slug                  = $request->input('slug');
        $job->lt_number             = $request->input('lt_number');
        $job->country               = $country;
        $job->client_id             = $request->input('client_id');
        $job->required_number       = $request->input('required_number');
        $job->salary                = $request->input('salary');
        $job->min_qualification     = $request->input('min_qualification');
        $job->description           = $request->input('description');
        $job->formlink              = $request->input('formlink');
        $job->start_date            = $start;
        $job->end_date              = $end;
        $job->updated_by            = Auth::user()->id;
        $oldimage                    = $job->image;

        if (!empty($request->file('image'))){
            $image                = $request->file('image');
            $name                 = uniqid().'_'.$image->getClientOriginalName();
            $path                 = base_path().'/public/images/uploads/jobs/';
            $moved                = Image::make($image->getRealPath())->resize(1280, 720)->orientate()->save($path.$name);
            if ($moved){
                $job->image = $name;
                if (!empty($oldimage) && file_exists(public_path().'/images/uploads/jobs/'.$oldimage)){
                    @unlink(public_path().'/images/uploads/jobs/'.$oldimage);
                }
            }
        }

        $status                     = $job->update();
        if($status){
            Session::flash('success','Job details was updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Job details could not be Updated');
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
        $delete       = Job::find($id);
        $rid          = $delete->id;
        if (!empty($delete->image) && file_exists(public_path().'/images/uploads/jobs/'.$delete->image)){
            @unlink(public_path().'/images/uploads/jobs/'.$delete->image);
        }
        $delete->delete();
        return '#job_'.$rid;
    }
}
