<?php namespace App\Http\Livewire;

use App\Vocabulary;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class VocabularyList extends Component
{
    public $vocabularies;
    public ?int $level;
    public bool $flat;
    public bool $range;
    public bool $showBurned = false;
    public bool $showLabels = false;
    public array $visible = [];

    public function burn(int $id)
    {
        $userId = auth()->id();

        /** @var Vocabulary $vocab */
        $vocab = Vocabulary::query()
            ->userBurnable($userId)
            ->findOrFail($id);

        if ($vocab->burnable === null) {
            $vocab->burn($userId);
        } else {
            $vocab->resurrect($userId);
        }
    }

    public function mount(int $level = null, string $kanji = null, bool $range = false)
    {
        $this->flat = $kanji !== null;
        $this->level = $level;
        $this->range = $range;
        $this->vocabularies = Vocabulary::query()
            ->orderBy('level')
            ->orderBy('meaning')
            ->userBurnable(auth()->id())
            ->when($kanji, fn (Builder $query) => $query->where('character', 'LIKE', "%{$kanji}%"))
            ->when($level, fn (Builder $query) => $query->where('level', $level))
            ->get(['id', 'level', 'character', 'kana', 'meaning']);
    }

    public function reveal(int $id)
    {
        $this->visible[$id] = empty($this->visible[$id]);
    }

    public function shuffle()
    {
        $this->vocabularies = $this->vocabularies->shuffle();
    }
}
