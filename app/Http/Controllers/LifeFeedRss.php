<?php namespace App\Http\Controllers;

use App\Trip;

class LifeFeedRss extends Controller
{
    public function index()
    {
        $meta = [
            'title' => trans('menu.life'),
            'link' => url(path('Life@index')),
            'description' => trans('life.rss.description'),
        ];

        $items = Trip::where('user_id', 1)
            ->where('status', Trip::STATUS_PUBLISHED)
            ->where('meta_image', '<>', '')
            ->take(50)
            ->get()
            ->map(function ($trip) {
                /* @var Trip $trip */
                $link = url($trip->www());
                $cover = '<p><a href="'.$link.'?from=rss-image"><img src="'.$trip->metaImage().'"></a></p>';

                return [
                    'title' => htmlspecialchars($trip->metaTitle()),
                    'link' => $link.'?from=rss-title',
                    'guid' => $link,
                    'description' => "{$cover}<p>{$trip->metaDescription()}</p>",
                    'pubDate' => $trip->date_start->toRfc2822String(),
                ];
            });

        return response()
            ->view('life.feed-rss', compact('items', 'meta'))
            ->header('Content-Type', 'application/xml');
    }
}
