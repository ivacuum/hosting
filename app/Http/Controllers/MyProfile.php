<?php namespace App\Http\Controllers;

use App\Http\Requests\MyProfileUpdateForm;

class MyProfile extends Controller
{
    public function edit()
    {
        return view('my.profile');
    }

    public function update(MyProfileUpdateForm $request)
    {
        $user = $request->user;
        $user->email = $request->email;
        $user->login = $request->username;
        $user->save();

        event(new \App\Events\Stats\MyProfileChanged);

        return back()->with('message', __('Изменения сохранены'));
    }
}
