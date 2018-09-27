<?php namespace App\Http\Controllers;

use App\News;
use Illuminate\Database\Eloquent\Builder;

class NewsRss extends Controller
{
    public function index()
    {
        $meta = [
            'title' => trans('news.index'),
            'link' => url(path('News@index')),
            'description' => trans('news.index'),
        ];

        $items = News::where('status', News::STATUS_PUBLISHED)
            ->where('locale', \App::getLocale())
            ->take(20)
            ->orderBy('id', 'desc')
            ->get()
            ->map(function (News $news) {
                $link = url($news->www());

                return [
                    'title' => $news->title,
                    'link' => $link.'?from=rss-title',
                    'guid' => $link,
                    'description' => $news->html,
                    'pubDate' => $news->created_at->toRfc2822String(),
                ];
            });

        return response()
            ->view('life.feed-rss', compact('items', 'meta'))
            ->header('Content-Type', 'application/xml');
    }
}
