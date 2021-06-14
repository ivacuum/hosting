<?php namespace App\Http\Controllers;

use App\Http\Requests\MySettingsUpdateForm;

class MySettings extends Controller
{
    public function edit()
    {
        return view('my.settings', ['user' => auth()->user()]);
    }

    public function update(MySettingsUpdateForm $request)
    {
        $user = $request->userModel();
        $user->update($request->validated());

        event(new \App\Events\Stats\MySettingsChanged);

        return back()->with('message', __('Изменения сохранены'));
    }
}
