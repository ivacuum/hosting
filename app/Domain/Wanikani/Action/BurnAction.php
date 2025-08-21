<?php

namespace App\Domain\Wanikani\Action;

use App\Domain\Wanikani\Models\Burnable;
use App\Domain\Wanikani\Models\Kanji;
use App\Domain\Wanikani\Models\Radical;
use App\Domain\Wanikani\Models\Vocabulary;
use Illuminate\Database\QueryException;

class BurnAction
{
    public function execute(Kanji|Radical|Vocabulary $burnable, int $userId): Burnable|null
    {
        try {
            return value($burnable->burnable()->create(['user_id' => $userId]));
        } catch (QueryException) {
            return null;
        }
    }
}
