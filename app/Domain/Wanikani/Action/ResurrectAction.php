<?php

namespace App\Domain\Wanikani\Action;

use App\Domain\Wanikani\Models\Kanji;
use App\Domain\Wanikani\Models\Radical;
use App\Domain\Wanikani\Models\Vocabulary;

class ResurrectAction
{
    public function execute(Kanji|Radical|Vocabulary $burnable, int $userId): int
    {
        return $burnable
            ->burnable()
            ->where('user_id', $userId)
            ->delete();
    }
}
