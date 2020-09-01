<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotifyController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt');
    }

    public function notify() 
    {
        return response()->json([
            'read' => auth()->user()->readNotifications,
            'unread' => auth()->user()->unreadNotifications
        ], 200);
    }

    public function readNotify(Request $request)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);

        auth()->user()->notifications->where('id', $request->id)->markAsRead();
        
        return response()->json([
            'message' => "Notification marked as read"
        ], 200);
    }
}
