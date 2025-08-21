<?php

namespace App\Domain\Wanikani\Livewire;

use App\Domain\Wanikani\Action\BurnAction;
use App\Domain\Wanikani\Action\ResurrectAction;
use App\Domain\Wanikani\Models\Vocabulary;
use App\Domain\Wanikani\Scope\UserBurnableScope;
use Livewire\Component;

class BurnVocabulary extends Component
{
    public int $id;
    public bool $burned = false;

    public function toggleBurned(BurnAction $burn, ResurrectAction $resurrect)
    {
        $userId = auth()->id();

        /** @var Vocabulary $vocab */
        $vocab = Vocabulary::query()
            ->tap(new UserBurnableScope($userId))
            ->findOrFail($this->id);

        if ($vocab->burnable === null) {
            $burn->execute($vocab, $userId);
            $this->burned = true;
        } else {
            $resurrect->execute($vocab, $userId);
            $this->burned = false;
        }
    }
}
