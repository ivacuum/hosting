<?php namespace App\Http\Controllers;

use App\User;

class UserTravel extends Controller
{
    /** @var \App\User $traveler */
    protected $traveler;

    protected function alwaysCallBefore(User $traveler)
    {
        $this->traveler = $traveler;

        \Breadcrumbs::push("@{$this->traveler->login}", "@{$this->traveler->login}");
    }

    protected function appendCustomVars(): void
    {
        view()->share(['traveler' => $this->traveler]);
    }
}
