<?php

namespace App\Observers;

use App\News;
use Illuminate\Support\Str;

class NewsObserver
{
    public function deleting(News $news)
    {
        \DB::transaction(function () use ($news) {
            $news->comments->each->delete();
        });
    }

    public function saving(News $news)
    {
        $this->maintainConsistency($news);
    }

    private function maintainConsistency(News $news): void
    {
        $news->title = Str::trim($news->title);
        $news->markdown = Str::trim($news->markdown);
    }
}
