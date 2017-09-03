<?php namespace App\Http\Controllers;

use Illuminate\Validation\Rule;

class MyProfile extends Controller
{
    public function edit()
    {
        return view('my.profile');
    }

    public function update()
    {
        /* @var \App\User $user */
        $user = request()->user();

        request()->validate([
            'mail' => 'empty',
            'email' => [
                'required',
                'email',
                'max:125',
                Rule::unique('users')->ignore($user->id),
            ],
            'username' => [
                'min:2',
                'max:32',
                'alpha_dash',
                Rule::unique('users', 'login')->ignore($user->id),
            ],
        ]);

        $user->login = request('username');
        $user->email = request('email');
        $user->save();

        event(new \App\Events\Stats\MyProfileChanged);

        return back()->with('message', trans('my.saved'));
    }
}
