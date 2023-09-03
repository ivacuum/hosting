<?php

namespace App\Livewire;

use App\Action\BurnAction;
use App\Action\ResurrectAction;
use App\Kanji;
use App\Scope\UserBurnableScope;
use Livewire\Component;

class BurnKanji extends Component
{
    public int $id;
    public bool $burned = false;

    public function toggleBurned(BurnAction $burn, ResurrectAction $resurrect)
    {
        $userId = auth()->id();

        /** @var Kanji $kanji */
        $kanji = Kanji::query()
            ->tap(new UserBurnableScope($userId))
            ->findOrFail($this->id);

        if ($kanji->burnable === null) {
            $burn->execute($kanji, $userId);
            $this->burned = true;
        } else {
            $resurrect->execute($kanji, $userId);
            $this->burned = false;
        }
    }
}
