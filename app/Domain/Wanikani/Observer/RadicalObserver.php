<?php

namespace App\Domain\Wanikani\Observer;

use App\Domain\Wanikani\Models\Radical;

class RadicalObserver
{
    public function deleting(Radical $radical)
    {
        \DB::transaction(static function () use ($radical) {
            $radical->burnables()->delete();
            $radical->kanjis()->detach();
        });
    }
}
