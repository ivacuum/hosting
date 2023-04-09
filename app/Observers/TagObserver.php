<?php namespace App\Observers;

use App\Tag;

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
}
