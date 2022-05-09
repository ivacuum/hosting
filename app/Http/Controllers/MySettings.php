<?php namespace App\Http\Controllers;

use App\Http\Requests\MySettingsUpdateForm;

class MySettings
{
    public function edit()
    {
        return view('my.settings', ['user' => auth()->user()]);
    }

    public function update(MySettingsUpdateForm $request)
    {
        $user = $request->userModel();
        $user->locale = $request->locale();
        $user->notify_gigs = $request->notifyGigs();
        $user->notify_news = $request->notifyNews();
        $user->notify_trips = $request->notifyTrips();
        $user->torrent_short_title = $request->torrentShortTitle();
        $user->save();

        event(new \App\Events\Stats\MySettingsChanged);

        return back()->with('message', __('Изменения сохранены'));
    }
}
