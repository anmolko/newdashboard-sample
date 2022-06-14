<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\RequestQuote;
use App\Models\Service;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $contacts           = Contact::all();
        return view('backend.contact.index',compact('contacts'));
    }

    public function responseIndex()
    {
        $quotes           = RequestQuote::all();
        return view('backend.quote.index',compact('quotes'));
    }



    public function edit($id)
    {
        $edit   = Contact::find($id);
        return response()->json($edit);
    }

    public function editResponse($id)
    {
        $edit   = Service::find($id);
        return response()->json($edit);
    }


    public function destroy($id)
    {
        $delete          = Contact::find($id);
        $id              = $delete->id;

        $status = $delete->delete();
        if($status){
            $status ='success';
            return response()->json(['status'=>$status,'id'=>$id,'message'=>'Customer contact info was removed!']);
        }
        else{
            $status ='error';
            return response()->json(['status'=>$status,'id'=>$id,'message'=>'Contact info could not be removed at the moment. Try Again later !']);
        }
    }

    public function responseDestroy($id)
    {
        $delete          = RequestQuote::find($id);
        $id              = $delete->id;

        $status = $delete->delete();
        if($status){
            $status ='success';
            return response()->json(['status'=>$status,'id'=>$id,'message'=>'Customer request quote info was removed!']);
        }
        else{
            $status ='error';
            return response()->json(['status'=>$status,'id'=>$id,'message'=>'Customer request quote info could not be removed at the moment. Try Again later !']);
        }
    }
}
