<?php

namespace App\Action;

use App\Burnable;
use App\Kanji;
use App\Radical;
use App\Vocabulary;
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
