<?php

namespace App\Domain\Wanikani\Livewire;

use App\Domain\Wanikani\Action\BurnAction;
use App\Domain\Wanikani\Action\ResurrectAction;
use App\Domain\Wanikani\Models\Kanji;
use App\Domain\Wanikani\Scope\UserBurnableScope;
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
