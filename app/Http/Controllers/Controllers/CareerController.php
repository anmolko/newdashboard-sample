<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CareerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $careers        = Career::all();
        return view('backend.career.index',compact('careers'));
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
        $end     = Carbon::createFromFormat('d/m/Y', $request->end_date)->format('Y-m-d');
        $data=[
            'name'              => $request->input('name'),
            'open_position'     => $request->input('open_position'),
            'end_date'          => $end,
            'from_link'         => $request->input('from_link'),
            'salary'            => $request->input('salary'),
            'type'              => $request->input('type'),
            'created_by'        => Auth::user()->id,
        ];
        $career = Career::create($data);
        if($career){
            Session::flash('success','Career created successfully !');
        } else{
            Session::flash('error','Something went wrong. Career could not be created!');
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
        $edit         = Career::find($id);
        $end          = Carbon::createFromFormat('Y-m-d', $edit->end_date)->format('d/m/Y');
        return response()->json(["edit"=>$edit,"end"=>$end]);
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
        $end                  = Carbon::createFromFormat('d/m/Y', $request->end_date)->format('Y-m-d');

        $career                  = Career::find($id);
        $career->name            = $request->input('name');
        $career->open_position   = $request->input('open_position');
        $career->from_link       = $request->input('from_link');
        $career->end_date        = $end;
        $career->salary          = $request->input('salary');
        $career->type            = $request->input('type');
        $career->updated_by      = Auth::user()->id;

        $status                  = $career->update();
        if($status){
            Session::flash('success','Career was updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Career could not be Updated');
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
        $delete       = Career::find($id);
        $rid          = $delete->id;
        $delete->delete();
        return '#career_'.$rid;
    }
}
