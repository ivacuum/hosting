<?php

namespace App\Http\Livewire;

use App\Action\BurnAction;
use App\Action\ResurrectAction;
use App\Radical;
use App\Scope\UserBurnableScope;
use Livewire\Component;

class BurnRadical extends Component
{
    public int $modelId;
    public bool $burned = false;

    public function mount(int $id, bool $burned = false)
    {
        $this->burned = $burned;
        $this->modelId = $id;
    }

    public function toggleBurned(BurnAction $burn, ResurrectAction $resurrect)
    {
        $userId = auth()->id();

        /** @var Radical $radical */
        $radical = Radical::query()
            ->tap(new UserBurnableScope($userId))
            ->findOrFail($this->modelId);

        if ($radical->burnable === null) {
            $burn->execute($radical, $userId);
            $this->burned = true;
        } else {
            $resurrect->execute($radical, $userId);
            $this->burned = false;
        }
    }
}
