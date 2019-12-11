<?php namespace App\Http\Controllers;

use App\Http\Requests\MyProfileUpdateRequest;

class MyProfile extends Controller
{
    public function edit()
    {
        return view('my.profile');
    }

    public function update(MyProfileUpdateRequest $request)
    {
        $user = $request->userModel();
        $user->email = $request->email();
        $user->login = $request->username();
        $user->save();

        event(new \App\Events\Stats\MyProfileChanged);

        return back()->with('message', trans('my.saved'));
    }
}
