<?php namespace App\Observers;

use App\Kanji;

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
