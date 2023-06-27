<?php

namespace App\Action;

use App\Kanji;
use App\Radical;
use App\Vocabulary;

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
