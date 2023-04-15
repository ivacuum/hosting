<?php namespace App\Http\Controllers;

class NotificationController
{
    public function index()
    {
        /** @var \App\User $user */
        $user = request()->user();
        $notifications = $user->notifications;

        $user->markNotificationsAsRead();

        return view('notifications.index', ['notifications' => $notifications]);
    }
}
