<?php

namespace App\Http\Controllers;

use App\Http\Requests\MyPasswordUpdateForm;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Http\Request;

class MyPasswordController
{
    public function edit(Request $request)
    {
        return view('my.password', [
            'hasPassword' => !empty($request->user()->password),
        ]);
    }

    public function update(MyPasswordUpdateForm $request, Hasher $hash)
    {
        $user = $request->user;

        if ($request->userHasPassword() && $request->isPasswordInvalid($hash)) {
            return back()->withErrors(['password' => 'Неверно введен текущий пароль']);
        }

        $user->password = $request->newPassword;
        $user->save();

        event(new \App\Events\Stats\MyPasswordChanged);

        return back()->with('message', __('Изменения сохранены'));
    }
}
