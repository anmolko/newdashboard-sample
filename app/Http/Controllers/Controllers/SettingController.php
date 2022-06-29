<?php

namespace App\Http\Controllers;


use App\Models\Award;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class SettingController extends Controller
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
        $settings = Setting::first();
        $awards   = Award::first();
        return view('backend.setting.settings',compact('settings','awards'));
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
            'website_name'              => $request->input('website_name'),
            'website_description'       => $request->input('website_description'),
            'phone'                     => $request->input('phone'),
            'font'                     => $request->input('font'),
            'mobile'                    => $request->input('mobile'),
            'whatsapp'                  => $request->input('whatsapp'),
            'grievance_link'            => $request->input('grievance_link'),
            'grievance_button'          => $request->input('grievance_button'),
            'grievance_heading'         => $request->input('grievance_heading'),
            'grievance_description'     => $request->input('grievance_description'),
            'viber'                     => $request->input('viber'),
            'facebook'                  => $request->input('facebook'),
            'youtube'                   => $request->input('youtube'),
            'instagram'                 => $request->input('instagram'),
            'address'                   => $request->input('address'),
            'email'                     => $request->input('email'),
            'google_analytics'          => $request->input('google_analytics'),
            'google_map'                => $request->input('google_map'),
            'created_by'                => Auth::user()->id,
        ];

        if (!empty($request->file('pop_image'))){
            $image     = $request->file('pop_image');
            $name1     = uniqid().'_pop_'.$image->getClientOriginalName();
            $path      = base_path().'/public/images/uploads/settings/';
            $moved     = Image::make($image->getRealPath())->orientate()->save($path.$name1);
            if ($moved){
                $data['pop_image']= $name1;
            }
        }

        $theme = Setting::create($data);
        if($theme){
            Session::flash('success','Settings Created Successfully');
        }
        else{
            Session::flash('error','Settings Creation Failed');
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
        $update_theme                           =  Setting::find($id);
        $update_theme->website_name             =  $request->input('website_name');
        $update_theme->website_description      =  $request->input('website_description');
        $update_theme->phone                    =  $request->input('phone');
        $update_theme->font                     =  $request->input('font');
        $update_theme->mobile                   =  $request->input('mobile');
        $update_theme->whatsapp                 =  $request->input('whatsapp');
        $update_theme->viber                    =  $request->input('viber');
        $update_theme->grievance_link           =  $request->input('grievance_link');
        $update_theme->grievance_button         =  $request->input('grievance_button');
        $update_theme->grievance_description    =  $request->input('grievance_description');
        $update_theme->grievance_heading        =  $request->input('grievance_heading');
        $update_theme->facebook                 =  $request->input('facebook');
        $update_theme->youtube                  =  $request->input('youtube');
        $update_theme->instagram                =  $request->input('instagram');
        $update_theme->address                  =  $request->input('address');
        $update_theme->email                    =  $request->input('email');
        $update_theme->google_analytics         =  $request->input('google_analytics');
        $update_theme->google_map               =  $request->input('google_map');
        $update_theme->updated_by               =  Auth::user()->id;
        $oldimage                               = $update_theme->pop_image;
        if (!empty($request->file('pop_image'))){
            $image     = $request->file('pop_image');
            $name1     = uniqid().'_pop_'.$image->getClientOriginalName();
            $path      = base_path().'/public/images/uploads/settings/';
            $moved     = Image::make($image->getRealPath())->orientate()->save($path.$name1);

            if ($moved){
                $update_theme->pop_image= $name1;
                if (!empty($oldimage) && file_exists(public_path().'/images/uploads/settings/'.$oldimage)){
                    @unlink(public_path().'/images/uploads/settings/'.$oldimage);
                }
            }
        }
        $status=$update_theme->update();

        if($status){
            Session::flash('success','Settings Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Settings could not be Updated');
        }
        return redirect()->back();
    }

    public function statusupdate(Request $request, $id)
    {
        $update_theme                           =  Setting::find($id);
        $update_theme->customer_served          =  $request->input('customer_served');
        $update_theme->visa_approved            =  $request->input('visa_approved');
        $update_theme->success_stories          =  $request->input('success_stories');
        $update_theme->happy_customers          =  $request->input('happy_customers');
        $update_theme->updated_by               =  Auth::user()->id;

        $status=$update_theme->update();

        if($status){
            Session::flash('success','Status Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Status could not be Updated');
        }
        return redirect()->back();
    }

    public function welcomeupdate(Request $request, $id){
        $actiontype                             = $request->input('action_type');
        $update_intro                           =  Setting::find($id);
        $update_intro->intro_heading            =  $request->input('intro_heading');
        $update_intro->intro_subheading         =  $request->input('intro_subheading');
        $update_intro->intro_description        =  $request->input('intro_description');
        $update_intro->intro_button             =  $request->input('intro_button');
        $update_intro->intro_button_link        =  $request->input('intro_button_link');
        $oldimage                               = $update_intro->intro_image;
        if (!empty($request->file('intro_image'))){
            $image     = $request->file('intro_image');
            $name1     = uniqid().'_'.$image->getClientOriginalName();
            $path      = base_path().'/public/images/uploads/settings/';
            $moved     = Image::make($image->getRealPath())->fit(510, 215)->orientate()->save($path.$name1);

            if ($moved){
                $update_intro->intro_image= $name1;
                if (!empty($oldimage) && file_exists(public_path().'/images/uploads/settings/'.$oldimage)){
                    @unlink(public_path().'/images/uploads/settings/'.$oldimage);
                }
            }
        }

        $status=$update_intro->update();

        if($status){
            Session::flash('success','Welcome Section Details '.$actiontype.' Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Welcome Section Details could not be '.$actiontype);
        }
        return redirect()->back();
    }

    public function imageupdate(Request $request, $id)
    {
        $update_theme                           =  Setting::find($id);
        $oldimage_logo                          = $update_theme->logo;
        $oldimage_logo_white                    = $update_theme->logo_white;
        $oldimage_favicon                       = $update_theme->favicon;

        if (!empty($request->file('logo'))){
            $path = base_path().'/public/images/uploads/settings';
            $image =$request->file('logo');
            $name1 = uniqid().'_'.$image->getClientOriginalName();
            if ($image->move($path,$name1)){
                $update_theme->logo= $name1;
                if (!empty($oldimage_logo) && file_exists(public_path().'/images/uploads/settings/'.$oldimage_logo)){
                    @unlink(public_path().'/images/uploads/settings/'.$oldimage_logo);
                }
            }

        }

        if (!empty($request->file('logo_white'))){
            $path = base_path().'/public/images/uploads/settings/';
            $image =$request->file('logo_white');
            $name1 = uniqid().'_'.$image->getClientOriginalName();
            if ($image->move($path,$name1)){
                $update_theme->logo_white= $name1;
                if (!empty($oldimage_logo_white) && file_exists(public_path().'/images/uploads/settings/'.$oldimage_logo_white)){
                    @unlink(public_path().'/images/uploads/settings/'.$oldimage_logo_white);
                }
            }

        }

        if (!empty($request->file('favicon'))){
            $path = base_path().'/public/images/uploads/settings/';
            $image =$request->file('favicon');
            $name1 = uniqid().'_'.$image->getClientOriginalName();
            if ($image->move($path,$name1)){
                $update_theme->favicon= $name1;
                if (!empty($oldimage_favicon) && file_exists(public_path().'/images/uploads/settings/'.$oldimage_favicon)){
                    @unlink(public_path().'/images/uploads/settings/'.$oldimage_favicon);
                }
            }

        }
        $status=$update_theme->update();

        if($status){
            Session::flash('success','Your Logo Images is Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Your Logo Images could not be Updated');
        }
        return redirect()->back();
    }

    public function callactionupdate(Request $request, $id){

        $calltype   = $request->input('call_type');
        $actiontype = $request->input('action_type');

        if($calltype == 'call_to_action_1'){
            $callaction                             =  Setting::find($id);
            $callaction->callaction1_heading        =  $request->input('callaction1_heading');
            $callaction->callaction1_button         =  $request->input('callaction1_button');
            $callaction->callaction1_button_link    =  $request->input('callaction1_button_link');
            $oldimage                               = $callaction->callaction1_image;
            if (!empty($request->file('callaction1_image'))){
                $image     = $request->file('callaction1_image');
                $name1     = uniqid().'_callaction1_'.$image->getClientOriginalName();
                $path      = base_path().'/public/images/uploads/settings/';
                $moved     = Image::make($image->getRealPath())->resize(1920, 950)->orientate()->save($path.$name1);

                if ($moved){
                    $callaction->callaction1_image = $name1;
                    if (!empty($oldimage) && file_exists(public_path().'/images/uploads/settings/'.$oldimage)){
                        @unlink(public_path().'/images/uploads/settings/'.$oldimage);
                    }
                }
            }
            $status= $callaction->update();
        }else{
            $callaction                             =  Setting::find($id);
            $callaction->callaction2_heading        =  $request->input('callaction2_heading');
            $callaction->callaction2_subheading     =  $request->input('callaction2_subheading');
            $callaction->callaction2_button         =  $request->input('callaction2_button');
            $callaction->callaction2_button_link    =  $request->input('callaction2_button_link');
            $status= $callaction->update();
        }

        if($status){
            Session::flash('success',str_replace('_',' ',ucfirst($calltype)).' has been '. $actiontype.' Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. '.str_replace('_',' ',ucfirst($calltype)).' Details could not be '.$actiontype);
        }
        return redirect()->back();
    }

    public function viewTeamdescp($id)
    {
        $edit   = Setting::find($id);
        return response()->json($edit);
    }

    public function teamDescriptionUpdate(Request $request, $id){
        $update_intro                         =  Setting::find($id);
        $update_intro->team_description       =  $request->input('team_description');
        $status=$update_intro->update();
        if($status){
            Session::flash('success','Team Description updated successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Team Description could not be updated');
        }
        return redirect()->back();
    }

    public function codeOfConduct(Request $request, $id){
        $update_intro                        =  Setting::find($id);
        $update_intro->code_of_conduct       =  $request->input('code_of_conduct');
        $status=$update_intro->update();
        if($status){
            Session::flash('success','Code of conduct updated successfully');
        }
        else{
            Session::flash('error','Something Went Wrong.Code of conduct could not be updated');
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
