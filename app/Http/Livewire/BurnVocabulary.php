<?php namespace App\Http\Livewire;

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

    public function toggleBurned()
    {
        $userId = auth()->id();

        /** @var Vocabulary $vocab */
        $vocab = Vocabulary::query()
            ->userBurnable($userId)
            ->findOrFail($this->modelId);

        if ($vocab->burnable === null) {
            $vocab->burn($userId);
            $this->burned = true;
        } else {
            $vocab->resurrect($userId);
            $this->burned = false;
        }
    }
}
