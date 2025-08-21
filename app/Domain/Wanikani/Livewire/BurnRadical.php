<?php

namespace App\Domain\Wanikani\Livewire;

use App\Domain\Wanikani\Action\BurnAction;
use App\Domain\Wanikani\Action\ResurrectAction;
use App\Domain\Wanikani\Models\Radical;
use App\Domain\Wanikani\Scope\UserBurnableScope;
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
