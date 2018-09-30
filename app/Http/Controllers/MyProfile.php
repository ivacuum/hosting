<?php namespace App\Http\Controllers;

use App\Http\Requests\MyProfileUpdate;

class MyProfile extends Controller
{
    public function edit()
    {
        return view('my.profile');
    }

    public function update(MyProfileUpdate $request)
    {
        /* @var \App\User $user */
        $user = $request->user();
        $user->login = $request->input('username');
        $user->email = $request->input('email');
        $user->save();

        event(new \App\Events\Stats\MyProfileChanged);

        return back()->with('message', trans('my.saved'));
    }
}
