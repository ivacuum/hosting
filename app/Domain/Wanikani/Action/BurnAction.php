<?php

namespace App\Domain\Wanikani\Action;

use App\Domain\Wanikani\Models\Burnable;
use App\Domain\Wanikani\Models\Kanji;
use App\Domain\Wanikani\Models\Radical;
use App\Domain\Wanikani\Models\Vocabulary;
use Illuminate\Database\UniqueConstraintViolationException;

class BurnAction
{
    public function execute(Kanji|Radical|Vocabulary $burnable, int $userId): Burnable|null
    {
        try {
            $burn = new Burnable;
            $burn->user_id = $userId;

            return $burnable->burnable()->save($burn) ?: null;
        } catch (UniqueConstraintViolationException) {
            return null;
        }
    }
}
