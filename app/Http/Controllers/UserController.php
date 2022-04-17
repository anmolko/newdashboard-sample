<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class UserController extends Controller
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
        //
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
        //
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
        //
    }

    public function profile(){
        $user_id        = Auth::user()->id;
        $user           = User::find($user_id);
        return view('backend.user.profile',compact('user'));
    }

    public function profileEdit($id=''){
        if($id == ''){
            $user_id        = Auth::user()->id;
            $user           = User::find($user_id);
            return view('backend.user.profile-edit',compact('user'));
        }else{
            $user_id        = $id;
            $user           = User::find($user_id);
            return view('backend.user.profile-edit',compact('user'));
        }
    }

    public function imageupdate(Request $request)
    {
        $user      = User::find($request->input('userid'));
        $name      = $request->input('name');
        if (!empty($request->file('image')) && $name =='image' ){
            $oldimage  = $user->image;
            $image       = $request->file('image');
            $name1       = uniqid().'_user_'.$image->getClientOriginalName();
            $path        = base_path().'/public/images/user/';
            $moved       = Image::make($image->getRealPath())->fit(200, 200, function ($constraint) {
                $constraint->aspectRatio(); //maintain image ratio
                $constraint->upsize();
            })->orientate()->save($path.$name1);

            if ($moved){
                $user->image = $name1;
                if (!empty($oldimage) && file_exists(public_path().'/images/user/'.$oldimage)){
                    @unlink(public_path().'/images/user/'.$oldimage);
                }
            }
        }

        if (!empty($request->file('image')) && $name =='cover'){
            $oldimage  = $user->cover;
            $image       = $request->file('image');
            $name1       = uniqid().'_cover_'.$image->getClientOriginalName();
            $path        = base_path().'/public/images/user/cover/';
            $moved       = Image::make($image->getRealPath())->fit(2000, 850)->orientate()->save($path.$name1);

            if ($moved){
                $user->cover= $name1;
                if (!empty($oldimage) && file_exists(public_path().'/images/user/cover/'.$oldimage)){
                    @unlink(public_path().'/images/user/cover/'.$oldimage);
                }
            }
        }

        $status = $user->update();
        if($status){
            $status = 'success';
        }else{
            $status = 'failed';
        }
         return response()->json(['status'=>$status,'image'=>$name1]);
    }

    public function checkoldpassword(Request $request){
        $user          = User::find($request->input('userid'));
        $incoming_pass = $request->input('oldpassword');
        if($incoming_pass == null){
            $status ='error';
            return response()->json(['status'=>$status,'message'=>'Please enter old password for verification first !']);
        }
        if (!Hash::check($incoming_pass, $user->password)) {
            $status ='error';
            return response()->json(['status'=>$status,'message'=>'The old password does not match our records.']);
        }else{
            $status ='success';
            return response()->json(['status'=>$status,'message'=>'Password check completed. Its a match !']);
        }
    }

    public function profileUpdate(Request $request, $id)
    {
        $user                 =  User::find($id);
        $user->name           =  $request->input('name');
        $user->email          =  $request->input('email');
        $user->gender         =  $request->input('gender');
        $user->contact        =  $request->input('contact');
        $user->user_type      =  $request->input('user_type');
        $user->address        =  $request->input('address');
        $user->about          =  $request->input('about');

//        if (!empty($request->file('image'))){
//            $image       = $request->file('image');
//            $name1       = uniqid().'_user_'.$image->getClientOriginalName();
//            $path        = base_path().'/public/images/user/';
//            $moved       = Image::make($image->getRealPath())->resize(200, 200, function ($constraint) {
//                $constraint->aspectRatio(); //maintain image ratio
//                $constraint->upsize();
//            })->orientate()->save($path.$name1);
//
//            if ($moved){
//                $user->image= $name1;
//                if (!empty($oldimage) && file_exists(public_path().'/images/user/'.$oldimage)){
//                    @unlink(public_path().'/images/user/'.$oldimage);
//                }
//            }
//        }
//        if (!empty($request->file('cover'))){
//            $image       = $request->file('cover');
//            $name1       = uniqid().'_cover_'.$image->getClientOriginalName();
//            $path        = base_path().'/public/images/user/cover/';
//            $moved       = Image::make($image->getRealPath())->resize(2000, 850, function ($constraint) {
//                $constraint->aspectRatio(); //maintain image ratio
//                $constraint->upsize();
//            })->orientate()->save($path.$name1);
//
//            if ($moved){
//                $user->cover= $name1;
//                if (!empty($oldimage) && file_exists(public_path().'/images/user/cover/'.$oldimage)){
//                    @unlink(public_path().'/images/user/cover/'.$oldimage);
//                }
//            }
//        }
        $status = $user->update();
        if($status){
            Session::flash('success','Changes were applied successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Changes could not be applied.');
        }
        return redirect()->route('profile');
    }

    public function profilepassword(Request $request){
        $id                 = $request->input('userid');
        $user               = User::find($id);
        $password           = Hash::make($request->input('password'));
        $user->password     = $password;
        $status             = User::where('id', $id)->update(array('password' => $password));
        if($status){
            $status ='success';
            return response()->json(['status'=>$status,'message'=>'Password has been changed !']);        }
        else{
            $status ='error';
            return response()->json(['status'=>$status,'message'=>'Your password could not be updated. Try Again later !']);
        }
    }

    public function removeAccount(Request $request){
        $id               = $request->input('userid');
        $user             = User::find($id);
        $cover            = $user->cover;
        $image            = $user->image;
        if (!empty($image) && file_exists(public_path().'/images/user/'.$image)){
            @unlink(public_path().'/images/user/'.$image);
        }
        if (!empty($cover) && file_exists(public_path().'/images/user/cover/'.$cover)){
            @unlink(public_path().'/images/user/cover/'.$cover);
        }
        $removeacc          = $user->delete();
        if($removeacc){
            $status ='success';
            return response()->json(['status'=>$status,'message'=>'Your account information has been removed! You will be logged out now.']);        }
        else{
            $status ='error';
            return response()->json(['status'=>$status,'message'=>'Account could not be removed. Try Again later !']);
        }
    }
}
