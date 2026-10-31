<?php

namespace App\Domain\Wanikani\Observer;

use App\Domain\Wanikani\Models\Vocabulary;
use App\Utilities\CacheHelper;

class VocabularyObserver
{
    public function __construct(private CacheHelper $cache) {}

    public function deleted(): void
    {
        $this->cache->forgetWanikaniVocabularyIds();
    }

    public function deleting(Vocabulary $vocab): void
    {
        \DB::transaction(static function () use ($vocab) {
            $vocab->burnables()->delete();
        });
    }

    public function saved(Vocabulary $vocab): void
    {
        if ($vocab->wasRecentlyCreated || $vocab->wasChanged('level')) {
            $this->cache->forgetWanikaniVocabularyIds();
        }
    }
}
