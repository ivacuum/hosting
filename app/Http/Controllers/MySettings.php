<?php namespace App\Http\Controllers;

use App\Http\Requests\MySettingsUpdateRequest;

class MySettings extends Controller
{
    public function edit()
    {
        return view('my.settings');
    }

    public function update(MySettingsUpdateRequest $request)
    {
        /** @var \App\User $user */
        $user = $request->user();
        $user->update($request->validated());

        event(new \App\Events\Stats\MySettingsChanged);

        return back()->with('message', trans('my.saved'));
    }
}
