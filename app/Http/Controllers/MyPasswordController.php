<?php

namespace App\Http\Controllers;

use App\Http\Requests\MyPasswordUpdateForm;
use App\User;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Contracts\Hashing\Hasher;

class MyPasswordController
{
    public function edit(#[CurrentUser] User $user)
    {
        return view('my.password', [
            'hasPassword' => !empty($user->password),
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
