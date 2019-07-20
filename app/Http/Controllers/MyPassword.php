<?php namespace App\Http\Controllers;

use App\Http\Requests\MyPasswordUpdate;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Http\Request;

class MyPassword extends Controller
{
    public function edit(Request $request)
    {
        return view('my.password', [
            'has_password' => !empty($request->user()->password),
        ]);
    }

    public function update(MyPasswordUpdate $request, Hasher $hash)
    {
        /* @var \App\User $user */
        $user = $request->user();
        $hasPassword = !empty($user->password);

        if ($hasPassword && !$hash->check($request->input('password'), $user->password)) {
            return back()->withErrors(['password' => 'Неверно введен текущий пароль']);
        }

        $user->password = $request->input('new_password');
        $user->save();

        event(new \App\Events\Stats\MyPasswordChanged);

        return back()->with('message', trans('my.saved'));
    }
}
