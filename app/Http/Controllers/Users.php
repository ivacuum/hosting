<?php namespace App\Http\Controllers;

use App\User;

class Users extends Controller
{
    public function index()
    {
        \Breadcrumbs::push(trans('users.index'));

        $users = User::active()->orderBy('id')->simplePaginate();

        return view($this->view, compact('users'));
    }

    public function show(User $user)
    {
        abort_unless($user->status === User::STATUS_ACTIVE, 404);

        \Breadcrumbs::push(trans('users.index'), 'users');
        \Breadcrumbs::push($user->publicName());

        return view($this->view, compact('user'));
    }
}
