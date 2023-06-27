<?php

namespace App\Http\Livewire;

use App\Action\BurnAction;
use App\Action\ResurrectAction;
use App\Kanji;
use App\Scope\UserBurnableScope;
use Livewire\Component;

class BurnKanji extends Component
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

        /** @var Kanji $kanji */
        $kanji = Kanji::query()
            ->tap(new UserBurnableScope($userId))
            ->findOrFail($this->modelId);

        if ($kanji->burnable === null) {
            $burn->execute($kanji, $userId);
            $this->burned = true;
        } else {
            $resurrect->execute($kanji, $userId);
            $this->burned = false;
        }
    }
}
