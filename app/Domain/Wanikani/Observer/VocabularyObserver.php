<?php

namespace App\Domain\Wanikani\Observer;

use App\Domain\Wanikani\Models\Vocabulary;

class VocabularyObserver
{
    public function deleting(Vocabulary $vocab)
    {
        \DB::transaction(function () use ($vocab) {
            $vocab->burnables()->delete();
        });
    }
}
