<?php

namespace App\Domain\Wanikani\Livewire;

use App\Domain\Wanikani\Models\Kanji;
use App\Domain\Wanikani\Models\Radical;
use App\Domain\Wanikani\Models\Vocabulary;
use Livewire\Component;

class WanikaniSearch extends Component
{
    /** @var \Illuminate\Database\Eloquent\Collection|\App\Domain\Wanikani\Models\Kanji[] */
    public $kanjis = [];

    /** @var \Illuminate\Database\Eloquent\Collection|\App\Domain\Wanikani\Models\Radical[] */
    public $radicals = [];

    /** @var \Illuminate\Database\Eloquent\Collection|\App\Domain\Wanikani\Models\Vocabulary[] */
    public $vocabularies = [];

    public int $count = 0;
    public string $q = '';

    public function clear()
    {
        $this->reset();
        $this->resetValidation();
    }

    public function search()
    {
        $this->validate([
            'q' => ['required', 'string', 'min:3'],
        ], [
            'min' => __('japanese.short-query'),
        ]);

        $this->radicals = Radical::query()
            ->where('meaning', 'LIKE', "%{$this->q}%")
            ->orderBy('level')
            ->orderBy('meaning')
            ->get(['id', 'level', 'character', 'meaning', 'image']);

        $this->kanjis = Kanji::query()
            ->where('meaning', 'LIKE', "%{$this->q}%")
            ->orderBy('level')
            ->orderBy('meaning')
            ->get(['id', 'level', 'character', 'meaning', 'onyomi', 'kunyomi', 'important_reading']);

        $this->vocabularies = Vocabulary::query()
            ->where('meaning', 'LIKE', "%{$this->q}%")
            ->orderBy('level')
            ->orderBy('meaning')
            ->get(['id', 'level', 'character', 'kana', 'meaning']);

        $this->count = $this->radicals->count() + $this->kanjis->count() + $this->vocabularies->count();
    }
}
