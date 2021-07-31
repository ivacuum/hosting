<?php namespace App\Http\Controllers;

use App\Domain\TripStatus;
use App\Trip;

class TripsRss extends Controller
{
    public function __invoke()
    {
        $meta = [
            'title' => __('Заметки'),
            'link' => url(path([Life::class, 'index'])),
            'description' => __('life.trips.rss.description'),
        ];

        $items = Trip::where('user_id', 1)
            ->where('status', TripStatus::PUBLISHED)
            ->where('meta_image', '<>', '')
            ->take(50)
            ->orderByDesc('date_start')
            ->get()
            ->map(function (Trip $trip) {
                $link = url($trip->www());
                $cover = '<p><a href="' . $link . '?from=rss-image"><img src="' . $trip->metaImage() . '" alt=""></a></p>';

                return [
                    'title' => htmlspecialchars($trip->metaTitle()),
                    'link' => $link . '?from=rss-title',
                    'guid' => $link,
                    'description' => "<p>{$trip->metaDescription()}</p>{$cover}",
                    'pubDate' => $trip->date_start->toRfc2822String(),
                ];
            });

        return response()
            ->view('life.feed-rss', ['items' => $items, 'meta' => $meta])
            ->header('Content-Type', 'application/xml');
    }
}
