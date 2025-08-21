<?php

namespace App\Domain\Life\Observer;

use App\Domain\Life\Models\Tag;
use Illuminate\Support\Str;

class TagObserver
{
    public function deleting(Tag $tag)
    {
        \DB::transaction(function () use ($tag) {
            foreach ($tag->photos as $photo) {
                $photo->tags()->detach($tag->id);
            }
        });
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
