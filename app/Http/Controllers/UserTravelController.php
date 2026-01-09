<?php

namespace App\Http\Controllers;

use App\User;

class UserTravelController extends Controller
{
    protected User|null $traveler = null;

    private function setup(User $traveler): void
    {
        $this->traveler = $traveler;

        \Breadcrumbs::push("@{$this->traveler->login}", "@{$this->traveler->login}");

        view()->share(['traveler' => $this->traveler]);
    }

    #[\Override]
    public function callAction($method, $parameters)
    {
        $this->setup(...array_values($parameters));

        return parent::callAction($method, $parameters);
    }
}
