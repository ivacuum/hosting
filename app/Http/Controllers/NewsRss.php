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

        $locale = \App::getLocale();

        $items = News::where('status', News::STATUS_PUBLISHED)
            ->when($locale === 'en', function (Builder $query) {
                return $query->where('site_id', 12);
            })
            ->when($locale === 'ru', function (Builder $query) {
                return $query->where('site_id', 11);
            })
            ->take(20)
            ->orderBy('id', 'desc')
            ->get()
            ->map(function ($news) {
                /* @var News $news */
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
