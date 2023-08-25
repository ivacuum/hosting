<?php

namespace App\Collection;

use App\Kanji;
use Illuminate\Database\Eloquent\Collection;

class ShowKanjiInTheSameOrderAsInVocab
{
    public function __construct(private array $characters)
    {
    }

    public function __invoke(Collection $collection)
    {
        if (count($this->characters) === 0) {
            return $collection;
        }

        // Сортировка кандзи в порядке использования в словарном слове
        return $collection
            ->transform(function (Kanji $item) {
                $item->sort = 0;

                foreach ($this->characters as $i => $character) {
                    $item->sort = $character === $item->character
                        ? $i * 10
                        : $item->sort;
                }

                return $item;
            })
            ->sortBy('sort')
            ->values();
    }
}
