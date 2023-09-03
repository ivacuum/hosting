<?php

namespace App\Livewire;

use App\Action\BurnAction;
use App\Action\ResurrectAction;
use App\Radical;
use App\Scope\UserBurnableScope;
use Livewire\Component;

class BurnRadical extends Component
{
    public int $id;
    public bool $burned = false;

    public function toggleBurned(BurnAction $burn, ResurrectAction $resurrect)
    {
        $userId = auth()->id();

        /** @var Radical $radical */
        $radical = Radical::query()
            ->tap(new UserBurnableScope($userId))
            ->findOrFail($this->id);

        if ($radical->burnable === null) {
            $burn->execute($radical, $userId);
            $this->burned = true;
        } else {
            $resurrect->execute($radical, $userId);
            $this->burned = false;
        }
    }
}
