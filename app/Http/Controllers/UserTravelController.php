<?php namespace App\Http\Controllers;

use App\User;

class UserTravelController extends Controller
{
    protected User|null $traveler = null;

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
