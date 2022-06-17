<?php

namespace App\Http\Controllers;

use App\Models\ApplyJob;
use App\Models\Contact;
use App\Models\Package;
use App\Models\RequestQuote;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markNotification(Request $request)
    {
        $user = auth()->user();
        $user->unreadNotifications->when($request->input('name'), function ($query) use ($request) {
                return $query->where('type', $request->input('name'));
            })->when($request->input('id'), function ($query) use ($request) {
                return $query->where('id', $request->input('id'));
            })->markAsRead();

        $unreadnotify    = auth()->user()->unreadNotifications->count();
        $service_num     = $user->notifications->where('read_at',null)->where('type','App\Notifications\NewServiceNotification')->count();
        $career_num      = $user->notifications->where('read_at',null)->where('type','App\Notifications\NewCareerNotification')->count();
        $others_num      = $user->notifications->where('read_at',null)->where('type','App\Notifications\OtherNotification')->count();
        foreach ($user->notifications as $notifi){
            $notifi->where('type', $request->input('name'))->whereNotNull('read_at')->delete();
        }
        return response()->json(['unread'=>$unreadnotify-1,'service_num'=>$service_num,'career_num'=>$career_num,'other_num'=>$others_num]);
    }

    public function sendToQuote($name)
    {
        $quotation = str_replace('-',' ',$name);
        $quotes    = RequestQuote::all();
        return view('backend.quote.index',compact('quotation','quotes'));
    }

    public function sendToCareerResponse($name)
    {
        $career_response    = str_replace('-',' ',$name);
        $applied_job        = ApplyJob::with('career')->get();
        return view('backend.career.response.index',compact('career_response','applied_job'));
    }

    public function sendToPlanResponse($name)
    {
        $plan_response    = str_replace('-',' ',$name);
        $packages         = Package::with('projectPlan')->get();
        return view('backend.package_response.index',compact('plan_response','packages'));
    }

    public function sendToContactResponse($name)
    {
        $contact_response   = str_replace('-',' ',$name);
        $contacts           = Contact::all();
        return view('backend.contact.index',compact('contact_response','contacts'));
    }

}
