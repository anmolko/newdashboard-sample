<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class FrontController extends Controller
{
    protected $contact = null;
    protected $setting = null;


    public function __construct(Setting $setting,Contact $contact)
    {
        $this->contact = $contact;
        $this->setting = $setting;
    }


    public function index()
    {

        return view('welcome');

    }

    public function contact()
    {
        return view('frontend.pages.contact');

    }

    public function contactStore(Request $request)
    {
        $data = [
            'name'        => $request->input('name'),
            'email'       => $request->input('email'),
            'phone'       => $request->input('phone'),
            'subject'     => $request->input('subject'),
            'message'     => $request->input('msg'),
        ];
        $status = $this->contact->create($data);

//         $theme_data = Setting::first();
//             $mail_data = array(
//                 'fullname'        =>$request->input('name'),
//                 'message'        =>$request->input('msg'),
//                 'email'        =>$request->input('email'),
//                 'subject'        =>$request->input('subject'),
//                 'address'        =>ucwords($theme_data->address),
//                 'site_email'        =>ucwords($theme_data->email),
//                 'site_name'        =>ucwords($theme_data->website_name),
//                 'phone'        =>ucwords($theme_data->phone),
//                 'logo'        =>ucwords($theme_data->logo),
//             );
// //             Mail::to($theme_data->email)->send(new ContactDetail($mail_data));

            if($status){
                Session::flash('success','Thank you for contacting us!');
                $confirmed = "success";
                return response()->json($confirmed);
            }
            else{
                Session::flash('error','Settings Creation Failed');
                $confirmed = "error";
                return response()->json($confirmed);
            }

           
        
    }
}
