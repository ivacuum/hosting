<?php namespace App\Http\Livewire;

use App\Radical;
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

    public function toggleBurned()
    {
        $userId = auth()->id();

        /** @var Radical $radical */
        $radical = Radical::query()
            ->userBurnable($userId)
            ->findOrFail($this->modelId);

        if ($radical->burnable === null) {
            $radical->burn($userId);
            $this->burned = true;
        } else {
            $radical->resurrect($userId);
            $this->burned = false;
        }
    }
}
