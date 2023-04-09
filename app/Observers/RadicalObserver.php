<?php namespace App\Observers;

use App\Radical;

class RadicalObserver
{
    public function deleting(Radical $radical)
    {
        \DB::transaction(function () use ($radical) {
            $radical->burnables()->delete();
            $radical->kanjis()->detach();
        });
    }
}
