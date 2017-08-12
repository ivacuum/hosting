<?php namespace App\Http\Controllers;

use Illuminate\Contracts\Hashing\Hasher;

class MyPassword extends Controller
{
    public function edit()
    {
        $has_password = !empty($this->request->user()->password);

        return view('my.password', compact('has_password'));
    }

    public function update(Hasher $hash)
    {
        $user = $this->request->user();
        $has_password = !empty($user->password);

        $this->validate($this->request, [
            'password' => $has_password ? 'required' : '',
            'new_password' => 'required|min:6',
        ]);

        if ($has_password && !$hash->check($this->request->input('password'), $user->password)) {
            return back()->withErrors(['password' => 'Неверно введен текущий пароль']);
        }

        $user->password = $this->request->input('new_password');
        $user->save();

        event(new \App\Events\Stats\MyPasswordChanged);

        return back()->with('message', trans('my.saved'));
    }
}
