<?php

namespace App\Domain\Life\Observer;

use App\Domain\Life\Models\Tag;
use Illuminate\Support\Str;

class TagObserver
{
    public function deleting(Tag $tag): void
    {
        $tag->photos()->detach();
    }

    public function saving(Tag $tag)
    {
        $this->maintainConsistency($tag);
    }

    private function maintainConsistency(Tag $tag): void
    {
        $tag->title_en = Str::trim($tag->title_en);
        $tag->title_ru = Str::trim($tag->title_ru);
    }
}
