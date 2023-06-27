<?php

namespace App\Http\Livewire;

use App\Kanji;
use App\Radical;
use App\Vocabulary;
use Livewire\Component;

class WanikaniSearch extends Component
{
    /** @var \Illuminate\Database\Eloquent\Collection|Kanji[] */
    public $kanjis = [];

    /** @var \Illuminate\Database\Eloquent\Collection|Radical[] */
    public $radicals = [];

    /** @var \Illuminate\Database\Eloquent\Collection|Vocabulary[] */
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

        $this->radicals = Radical::where('meaning', 'LIKE', "%{$this->q}%")
            ->orderBy('level')
            ->orderBy('meaning')
            ->get(['id', 'level', 'character', 'meaning', 'image']);

        $this->kanjis = Kanji::where('meaning', 'LIKE', "%{$this->q}%")
            ->orderBy('level')
            ->orderBy('meaning')
            ->get(['id', 'level', 'character', 'meaning', 'onyomi', 'kunyomi', 'important_reading']);

        $this->vocabularies = Vocabulary::where('meaning', 'LIKE', "%{$this->q}%")
            ->orderBy('level')
            ->orderBy('meaning')
            ->get(['id', 'level', 'character', 'kana', 'meaning']);

        $this->count = $this->radicals->count() + $this->kanjis->count() + $this->vocabularies->count();
    }
}
