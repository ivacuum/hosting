<?php namespace App\Http\Livewire;

use App\Kanji;
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

    public function toggleBurned()
    {
        $userId = auth()->id();

        /** @var Kanji $kanji */
        $kanji = Kanji::query()
            ->userBurnable($userId)
            ->findOrFail($this->modelId);

        if ($kanji->burnable === null) {
            $kanji->burn($userId);
            $this->burned = true;
        } else {
            $kanji->resurrect($userId);
            $this->burned = false;
        }
    }
}
