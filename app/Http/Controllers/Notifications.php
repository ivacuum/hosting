<?php namespace App\Http\Controllers;

use Carbon\Carbon;

class Notifications extends Controller
{
    public function index()
    {
        $user = $this->request->user();
        $notifications = $user->notifications;

        $user->unreadNotifications()->update(['read_at' => Carbon::now()]);

        return view($this->view, compact('notifications'));
    }
}
