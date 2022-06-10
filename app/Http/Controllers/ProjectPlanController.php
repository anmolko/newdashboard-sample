<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\ProjectPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProjectPlanController extends Controller
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
        $project_plan      = ProjectPlan::all();
        return view('backend.project_plan.index',compact('project_plan'));
    }

    public function packageIndex()
    {
        $packages      = Package::with('projectPlan')->get();
        return view('backend.package_response.index',compact('packages'));
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
            'name'             => $request->input('name'),
            'price'            => $request->input('price'),
            'type'             => $request->input('type'),
            'description'      => $request->input('description'),
            'link'             => $request->input('link'),
            'created_by'       => Auth::user()->id,
        ];
        $service = ProjectPlan::create($data);
        if($service){
            Session::flash('success','Project Plan was created successfully !');
        }
        else{
            Session::flash('error','Project Plan could not be created at the moment !');
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
        $edit      = ProjectPlan::find($id);
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
        $plan                       = ProjectPlan::find($id);
        $plan->name                 = $request->input('name');
        $plan->price                = $request->input('price');
        $plan->type                 = $request->input('type');
        $plan->description          = $request->input('description');
        $plan->link                 = $request->input('link');
        $plan->updated_by           =  Auth::user()->id;

        $status                     = $plan->update();
        if($status){
            Session::flash('success','Project Plan was updated successfully !');
        }
        else{
            Session::flash('error','Something Went Wrong. Project Plan could not be updated at the moment !');
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
        $delete          = ProjectPlan::find($id);
        $rid             = $delete->id;
        $delete->delete();
        $status ='success';
        return response()->json(['status'=>$status,'id'=>$rid,'message'=>'Project Plan was removed!']);
    }

    public function packageDestroy($id)
    {
        $delete          = Package::find($id);
        $rid             = $delete->id;
        $delete->delete();
        $status ='success';
        return response()->json(['status'=>$status,'id'=>$rid,'message'=>'Customer package response was removed!']);
    }
}
