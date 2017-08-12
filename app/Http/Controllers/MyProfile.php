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
        $user = $this->request->user();

        $this->validate($this->request, [
            'mail' => 'empty',
            'username' => [
                'min:2',
                'max:32',
                'alpha_dash',
                Rule::unique('users', 'login')->ignore($user->id),
            ],
            'email' => [
                'required',
                'email',
                'max:125',
                Rule::unique('users')->ignore($user->id),
            ],
        ]);

        $user->login = $this->request->input('username');
        $user->email = $this->request->input('email');
        $user->save();

        event(new \App\Events\Stats\MyProfileChanged);

        return back()->with('message', trans('my.saved'));
    }
}
