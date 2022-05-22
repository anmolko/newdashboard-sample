<?php

namespace App\Http\Controllers;

use App\Models\CallAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CallActionController extends Controller
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
        $callactions = CallAction::all();
        return view('backend.call_action.index',compact('callactions'));
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

        $call         =  CallAction::create([
                'name'        => $request->input('name'),
                'title'       => $request->input('title'),
                'button'      => $request->input('button'),
                'link'        => $request->input('link'),
                'created_by'  => Auth::user()->id,
            ]);
            if($call){
                $calls = CallAction::latest()->first();
                $status ='success';
                return response()->json(['status'=>$status,'message'=>'Call Action has been added.','call'=>$calls]);
            }
            else{
                $status ='error';
                return response()->json(['status'=>$status,'message'=>'Could not create call action at the moment. Try Again later !']);
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
        $edit    = CallAction::find($id);
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
        $call               = CallAction::find($id);
        $call->name         = $request->input('name');
        $call->title        = $request->input('title');
        $call->button       = $request->input('button');
        $call->link         = $request->input('link');
        $call->updated_by   = Auth::user()->id;
        $status             = $call->update();

        if($status){
            Session::flash('success','Call Action has been updated');
        }
        else{
            Session::flash('error','Something Went Wrong. Call Action could not be Updated');
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
        $delete       = CallAction::find($id);
        $rid          = $delete->id;
        $check        = $delete->services()->get();
        $count        = $delete->count();
        if ($check->count() > 0) {
            $status ='error';
            return response()->json(['status'=>$status,'id'=>$rid,'count'=>$count,'message'=>'Call Action is currently in use with different services. Try removing them first !']);
        }else{
            $delete->delete();
            $status ='success';
            return response()->json(['status'=>$status,'count'=>$count,'id'=>$rid,'message'=>'Call Action was removed!']);
        }
    }
}
