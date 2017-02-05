<?php namespace App\Http\Controllers;

class Notifications extends Controller
{
    public function index()
    {
        $user = $this->request->user();
        $notifications = $user->notifications;

        $user->markNotificationsAsRead();

        return view($this->view, compact('notifications'));
    }
}
