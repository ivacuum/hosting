<?php

namespace App\Http\Controllers;

use App\Http\Requests\MySettingsUpdateForm;
use App\User;
use Illuminate\Container\Attributes\CurrentUser;

class MySettingsController
{
    public function edit(#[CurrentUser] User $user)
    {
        return view('my.settings', ['user' => $user]);
    }

    public function update(MySettingsUpdateForm $request)
    {
        $user = $request->user;
        $user->locale = $request->theLocale;
        $user->notify_gigs = $request->notifyGigs;
        $user->notify_news = $request->notifyNews;
        $user->notify_trips = $request->notifyTrips;
        $user->magnet_short_title = $request->magnetShortTitle;
        $user->save();

        event(new \App\Events\Stats\MySettingsChanged);

        return back()->with('message', __('Изменения сохранены'));
    }
}
