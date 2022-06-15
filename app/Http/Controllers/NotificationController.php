<?php

namespace App\Http\Controllers;

use App\Models\RequestQuote;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markNotification(Request $request)
    {
        $user = auth()->user();
        $status = $user->unreadNotifications
            ->when($request->input('id'), function ($query) use ($request) {
                return $query->where('id', $request->input('id'));
            })
            ->markAsRead();

        $unreadnotify = auth()->user()->unreadNotifications->count();

        return response()->json(['unread'=>$unreadnotify-1]);

    }

    public function sendToQuote($name)
    {
        $quotation = str_replace('-',' ',$name);
        $quotes    = RequestQuote::all();
        return view('backend.quote.index',compact('quotation','quotes'));
    }

}
