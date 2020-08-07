<?php namespace App\Http\Controllers;

use App\News;

class NewsRss extends Controller
{
    public function index()
    {
        $meta = [
            'title' => __('Новости'),
            'link' => url(path([\App\Http\Controllers\News::class, 'index'])),
            'description' => __('Новости'),
        ];

        $items = News::where('status', News::STATUS_PUBLISHED)
            ->where('locale', \App::getLocale())
            ->take(20)
            ->orderByDesc('id')
            ->get()
            ->map(function (News $news) {
                $link = url($news->www());

                return [
                    'title' => $news->title,
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
