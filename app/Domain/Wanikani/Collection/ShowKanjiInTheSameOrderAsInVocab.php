<?php

namespace App\Domain\Wanikani\Collection;

use App\Domain\Wanikani\Models\Kanji;
use Illuminate\Database\Eloquent\Collection;

class ShowKanjiInTheSameOrderAsInVocab
{
    /** @param list<string> $characters */
    public function __construct(private array $characters) {}

    public function __invoke(Collection $collection): Collection
    {
        if (count($this->characters) === 0) {
            return $collection;
        }

        return $collection
            ->sortBy(fn (Kanji $kanji): int|false => array_search($kanji->character, $this->characters, true))
            ->values();
    }
}
