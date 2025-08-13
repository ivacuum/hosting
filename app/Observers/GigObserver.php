<?php

namespace App\Observers;

use App\Gig;
use App\Utilities\CacheHelper;
use Illuminate\Support\Str;

class GigObserver
{
    public function __construct(private CacheHelper $cache) {}

    public function deleted()
    {
        $this->cache->forgetGigs();
    }

    public function saved()
    {
        $this->cache->forgetGigs();
    }

    public function saving(Gig $gig)
    {
        $this->maintainConsistency($gig);
    }

    private function maintainConsistency(Gig $gig): void
    {
        $gig->slug = Str::trim($gig->slug);
        $gig->title_en = Str::trim($gig->title_en);
        $gig->title_ru = Str::trim($gig->title_ru);
        $gig->meta_image = Str::trim($gig->meta_image);
        $gig->meta_description_en = Str::trim($gig->meta_description_en);
        $gig->meta_description_ru = Str::trim($gig->meta_description_ru);
    }
}
