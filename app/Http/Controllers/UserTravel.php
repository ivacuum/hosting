<?php namespace App\Http\Controllers;

use App\User;

class UserTravel extends Controller
{
    /** @var \App\User $traveler */
    protected $traveler;

    protected function alwaysCallBefore(string $login)
    {
        $this->traveler = User::where('login', $login)->firstOrFail();

        \Breadcrumbs::push("@{$this->traveler->login}", "@{$this->traveler->login}");
    }

    protected function appendViewSharedVars(): void
    {
        parent::appendViewSharedVars();

        view()->share(['traveler' => $this->traveler]);
    }
}
