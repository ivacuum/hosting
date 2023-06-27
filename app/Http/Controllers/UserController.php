<?php

namespace App\Http\Controllers;

use App\Scope\UserActiveScope;
use App\User;

class UserController
{
    public function index()
    {
        $users = User::query()
            ->tap(new UserActiveScope)
            ->orderBy('id')
            ->simplePaginate();

        return view('users.index', ['users' => $users]);
    }

    public function show(User $user)
    {
        abort_unless($user->isActive(), 404);

        $user->loadCount(['comments', 'images', 'magnets']);

        \Breadcrumbs::push($user->publicName());

        return view('users.show', ['user' => $user]);
    }
}
