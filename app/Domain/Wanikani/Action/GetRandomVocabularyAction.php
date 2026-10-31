<?php

namespace App\Domain\Wanikani\Action;

use App\Domain\CacheKey;
use App\Domain\Wanikani\Models\Vocabulary;
use Illuminate\Cache\Repository;
use Illuminate\Support\Arr;

class GetRandomVocabularyAction
{
    public function __construct(private Repository $cache) {}

    public function execute(int $startLevel, int $endLevel): Vocabulary
    {
        $key = CacheKey::WanikaniVocabularyIdsByLevels;

        $ids = $this->cache->remember($key->key("{$startLevel}-{$endLevel}"), $key->ttl(), static function () use ($startLevel, $endLevel): array {
            return Vocabulary::query()
                ->whereBetween('level', [$startLevel, $endLevel])
                ->toBase()
                ->pluck('id')
                ->all();
        });

        return Vocabulary::query()->findOrFail(Arr::random($ids));
    }
}
