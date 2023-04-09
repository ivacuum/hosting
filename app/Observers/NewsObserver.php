<?php namespace App\Observers;

use App\News;

class NewsObserver
{
    public function deleting(News $news)
    {
        \DB::transaction(function () use ($news) {
            $news->comments->each->delete();
        });
    }
}
