<?php namespace App\Http\Controllers;

use App\User;

class Users extends Controller
{
    public function index()
    {
        $users = User::active()->orderBy('id')
            ->simplePaginate()
            ->withPath(path([$this->controller, 'index']));

        return view($this->view, ['users' => $users]);
    }

    public function show(int $id)
    {
        /** @var User $user */
        $user = User::withCount(['comments', 'images', 'torrents'])
            ->findOrFail($id);

        abort_unless($user->status === User::STATUS_ACTIVE, 404);

        \Breadcrumbs::push($user->publicName());

        return view($this->view, ['user' => $user]);
    }

    protected function appendBreadcrumbs(): void
    {
        $this->middleware('breadcrumbs:users.index,users');
    }
}
