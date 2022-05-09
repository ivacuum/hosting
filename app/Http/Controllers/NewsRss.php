<?php namespace App\Http\Controllers;

use App\Domain\NewsStatus;
use App\News;

class NewsRss
{
    public function __invoke()
    {
        $meta = [
            'title' => __('Новости'),
            'link' => url(path([NewsController::class, 'index'])),
            'description' => __('Новости'),
        ];

        $items = News::query()
            ->where('status', NewsStatus::Published)
            ->where('locale', \App::getLocale())
            ->take(20)
            ->orderByDesc('id')
            ->get()
            ->map(function (News $news) {
                $link = url($news->www());

                return [
                    'title' => htmlspecialchars($news->title),
                    'link' => $link . '?from=rss-title',
                    'guid' => $link,
                    'description' => $news->html,
                    'pubDate' => $news->created_at->toRfc2822String(),
                ];
            });

        return response()
            ->view('life.feed-rss', ['items' => $items, 'meta' => $meta])
            ->header('Content-Type', 'application/xml');
    }
}
