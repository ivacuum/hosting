<?php

namespace App\Domain\Wanikani\Observer;

use App\Domain\Wanikani\Models\Kanji;

class KanjiObserver
{
    public function deleting(Kanji $kanji)
    {
        \DB::transaction(function () use ($kanji) {
            $kanji->burnables()->delete();
            $kanji->radicals()->detach();
        });
    }
}
