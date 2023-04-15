<?php namespace App\Http\Controllers;

use App\Scope\TripOfAdminScope;
use App\Scope\TripPublishedScope;
use App\Scope\TripWithCoverScope;
use App\Trip;

class TripsRssController
{
    public function __invoke()
    {
        $meta = [
            'title' => __('Заметки'),
            'link' => url(path([LifeController::class, 'index'])),
            'description' => __('life.trips.rss.description'),
        ];

        $items = Trip::query()
            ->tap(new TripOfAdminScope)
            ->tap(new TripPublishedScope)
            ->tap(new TripWithCoverScope)
            ->take(50)
            ->orderByDesc('date_start')
            ->get()
            ->map($this->mapTrip(...));

        return response()
            ->view('life.feed-rss', ['items' => $items, 'meta' => $meta])
            ->header('Content-Type', 'application/xml');
    }

    private function mapTrip(Trip $trip): array
    {
        $link = url($trip->www());
        $cover = '<p><a href="' . $link . '?from=rss-image"><img src="' . $trip->metaImage() . '" alt=""></a></p>';

        return [
            'title' => htmlspecialchars($trip->metaTitle()),
            'link' => $link . '?from=rss-title',
            'guid' => $link,
            'description' => "<p>{$trip->metaDescription()}</p>{$cover}",
            'pubDate' => $trip->date_start->toRfc2822String(),
        ];
    }
}
