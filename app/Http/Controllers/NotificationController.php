<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function userNotification(Request $request)
    {
        $notifications =  auth('users')->user()->notifications;
        $data['records'] = auth('users')->user()->notifications()->latest()->paginate();

        foreach ($notifications as $notification) {
            $notification->update(['when_read' => now()]);
        }

        $data['page_title'] = __('site.notifications');
        return view('user_notifications', $data);
    }
}
