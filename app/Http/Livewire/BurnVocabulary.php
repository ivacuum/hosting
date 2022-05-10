<?php namespace App\Http\Livewire;

use App\Action\BurnAction;
use App\Action\ResurrectAction;
use App\Scope\UserBurnableScope;
use App\Vocabulary;
use Livewire\Component;

class BurnVocabulary extends Component
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

        /** @var Vocabulary $vocab */
        $vocab = Vocabulary::query()
            ->tap(new UserBurnableScope($userId))
            ->findOrFail($this->modelId);

        if ($vocab->burnable === null) {
            $burn->execute($vocab, $userId);
            $this->burned = true;
        } else {
            $resurrect->execute($vocab, $userId);
            $this->burned = false;
        }
    }
}
