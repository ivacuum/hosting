<?php namespace App\Observers;

use App\Vocabulary;

class VocabularyObserver
{
    public function deleting(Vocabulary $vocab)
    {
        \DB::transaction(function () use ($vocab) {
            $vocab->burnables()->delete();
        });
    }
}
