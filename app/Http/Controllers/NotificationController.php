<?php

namespace App\Http\Controllers;

use App\Models\RequestQuote;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markNotification(Request $request)
    {
        $user = auth()->user();
        $user->unreadNotifications
            ->when($request->input('id'), function ($query) use ($request) {
                return $query->where('id', $request->input('id'));
            })->markAsRead();

        $unreadnotify     = auth()->user()->unreadNotifications->count();
        foreach ($user->notifications as $notifi){
            $notifi->whereNotNull('read_at')->delete();
        }
        $service_num      = $user->notifications->where('read_at',null)->where('type','App\Notifications\NewServiceNotification')->count();
        $career_num      = $user->notifications->where('read_at',null)->where('type','App\Notifications\NewCareerNotification')->count();

        return response()->json(['unread'=>$unreadnotify-1,'service_num'=>$service_num,'career_num'=>$service_num]);
    }

    public function sendToQuote($name)
    {
        $quotation = str_replace('-',' ',$name);
        $quotes    = RequestQuote::all();
        return view('backend.quote.index',compact('quotation','quotes'));
    }

}
