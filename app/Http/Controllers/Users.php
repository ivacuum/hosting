<?php namespace App\Http\Controllers;

use App\User;

class Users extends Controller
{
    public function index()
    {
        $users = User::active()->orderBy('id')->simplePaginate();

        return view($this->view, compact('users'));
    }

    public function show($id)
    {
        /* @var User $user */
        $user = User::withCount(['comments', 'images', 'torrents'])
            ->findOrFail($id);

        abort_unless($user->status === User::STATUS_ACTIVE, 404);

        \Breadcrumbs::push($user->publicName());

        return view($this->view, compact('user'));
    }

    protected function appendBreadcrumbs(): void
    {
        $this->middleware('breadcrumbs:users.index,users');
    }
}
