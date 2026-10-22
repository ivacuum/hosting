<?php

namespace App\Domain\Wanikani\Livewire;

use App\Domain\Wanikani\Action\BurnAction;
use App\Domain\Wanikani\Action\ResurrectAction;
use App\Domain\Wanikani\Models\Vocabulary;
use App\Domain\Wanikani\Scope\UserBurnableScope;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class BurnVocabulary extends Component
{
    public int $id;
    public bool $burned = false;

    public function render(): View
    {
        return view('livewire.burn-vocabulary');
    }

    public function toggleBurned(BurnAction $burn, ResurrectAction $resurrect): void
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
