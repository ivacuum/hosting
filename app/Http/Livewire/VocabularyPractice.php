<?php namespace App\Http\Livewire;

use App\Vocabulary;
use Livewire\Component;

class VocabularyPractice extends Component
{
    const MAX_HISTORY = 5;

    /** @var Vocabulary */
    public $vocab;

    /** @var \Illuminate\Support\Collection */
    public $history = [];

    public $answer = '';
    public $reveal = false;
    public $answered = 0;

    public function check()
    {
        if (in_array(trim($this->answer), [$this->vocab->toRomaji(), $this->vocab->kana, $this->vocab->character])) {
            $this->answer = '';
            $this->reveal = false;
            $this->answered++;
            $this->pushHistory();
            $this->pickRandomVocab();

            return;
        }

        $this->reveal = true;
    }

    public function mount()
    {
        $this->pickRandomVocab();
    }

    public function next()
    {
        $this->pickRandomVocab();
    }

    public function render()
    {
        return view('livewire.vocabulary-practice');
    }

    private function pickRandomVocab()
    {
        $this->vocab = Vocabulary::query()
            ->inRandomOrder()
            ->first();
    }

    private function pushHistory()
    {
        unset($this->history[self::MAX_HISTORY - 1]);

        array_unshift($this->history, [
            'www' => $this->vocab->www(),
            'kana' => $this->vocab->firstKana(),
            'meaning' => $this->vocab->meaning,
            'character' => $this->vocab->character,
        ]);
    }
}
