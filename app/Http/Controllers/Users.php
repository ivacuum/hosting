<?php namespace App\Http\Controllers;

use App\User;

class Users extends Controller
{
    public function index()
    {
        $users = User::query()
            ->active()
            ->orderBy('id')
            ->simplePaginate();

        return view('users.index', ['users' => $users]);
    }

    public function show(int $id)
    {
        /** @var User $user */
        $user = User::query()
            ->withCount(['comments', 'images', 'torrents'])
            ->findOrFail($id);

        abort_unless($user->isActive(), 404);

        \Breadcrumbs::push($user->publicName());

        return view('users.show', ['user' => $user]);
    }
}
