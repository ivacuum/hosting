<?php namespace App\Http\Controllers;

use App\Http\Requests\MySettingsUpdate;

class MySettings extends Controller
{
    public function edit()
    {
        return view('my.settings');
    }

    public function update(MySettingsUpdate $request)
    {
        /* @var \App\User $user */
        $user = $request->user();
        $user->update($request->validated());

        event(new \App\Events\Stats\MySettingsChanged);

        return back()->with('message', trans('my.saved'));
    }
}
