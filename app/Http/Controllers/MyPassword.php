<?php namespace App\Http\Controllers;

use Illuminate\Contracts\Hashing\Hasher;

class MyPassword extends Controller
{
    public function edit()
    {
        $has_password = !empty(request()->user()->password);

        return view('my.password', compact('has_password'));
    }

    public function update(Hasher $hash)
    {
        /* @var \App\User $user */
        $user = request()->user();
        $has_password = !empty($user->password);

        request()->validate([
            'password' => $has_password ? 'required' : '',
            'new_password' => 'required|min:6',
        ]);

        if ($has_password && !$hash->check(request('password'), $user->password)) {
            return back()->withErrors(['password' => 'Неверно введен текущий пароль']);
        }

        $user->password = request('new_password');
        $user->save();

        event(new \App\Events\Stats\MyPasswordChanged);

        return back()->with('message', trans('my.saved'));
    }
}
