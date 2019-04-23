<?php

namespace App\Http\Controllers;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;
use App\User;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $user = auth()->user();
        return view('notifications.index', compact('user'));
    }

    public function getNotifications()
    {
        $user = auth()->user();
        $notifications = $user->unreadNotifications;
        return response()->json($notifications);
        return view('notifications.index', compact('user'));
    }

    /**
     * Display the specified resource.
     *
     * @param  char  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $user = User::find(1);
        $notification = DB::table('notifications')->where('id', $id)->first();


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
            return redirect()->route('notification.index');
        }
        return back();
    }

    public function markAsReadNotification(DatabaseNotification $notification)
    {
        $notification->markAsRead();
        return back();
    }
}
