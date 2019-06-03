<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use App\User;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        return view('notifications.index', compact('user'));
    }

    public function getNotifications()
    {
        $user = auth()->user();
        $notifications = $user->unreadNotifications;
        return response()->json($notifications);
    }

    /**
     * Display the specified resource.
     *
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $user = User::find(1);
        $notification = DB::table('notifications')->where('id', $id)->first();
        //dd($notification);

        $notif = [
            'id' => $notification->id,
            'type' => $notification->type,
            'data' => json_decode($notification->data, true)
        ];

        return view('notifications.show', compact('user', 'notif'));


    }

    public function update(Request $request, DatabaseNotification $notification)
    {
        $notification->markAsRead();
        if($request->user()->unreadNotifications->isEmpty()) {
            return redirect()->route('home');
        }else{
            return redirect()->route('notifications.index');
        }
    }

    public function unread(Request $request, DatabaseNotification $notif)
    {
        $notif->markAsUnread();
        if($request->user()->unreadNotifications->isEmpty()) {
            return redirect()->route('home');
        }else{
            return redirect()->route('notifications.index');
        }
    }

}
