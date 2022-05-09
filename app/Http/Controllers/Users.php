<?php namespace App\Http\Controllers;

use App\Scope\UserActiveScope;
use App\User;

class Users
{
    public function index()
    {
        $users = User::query()
            ->tap(new UserActiveScope)
            ->orderBy('id')
            ->simplePaginate();

        return view('users.index', ['users' => $users]);
    }

    public function show(int $id)
    {
        /** @var User $user */
        $user = User::query()
            ->withCount(['comments', 'images', 'magnets'])
            ->findOrFail($id);

        abort_unless($user->isActive(), 404);

        \Breadcrumbs::push($user->publicName());

        return view('users.show', ['user' => $user]);
    }
}
