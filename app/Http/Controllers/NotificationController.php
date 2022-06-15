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
        $unreadnotify = auth()->user()->unreadNotifications->count();
        //removing all the read notification
        foreach ($user->notifications as $notifi){
            $notifi->whereNotNull('read_at')->delete();
        }
        return response()->json(['unread'=>$unreadnotify-1]);
    }

    public function sendToQuote($name)
    {
        $quotation = str_replace('-',' ',$name);
        $quotes    = RequestQuote::all();
        return view('backend.quote.index',compact('quotation','quotes'));
    }

}
