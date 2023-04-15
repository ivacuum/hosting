<?php namespace App\Http\Controllers;

use App\Domain\GigStatus;
use App\Gig;

class GigsRssController
{
    public function __invoke()
    {
        $meta = [
            'title' => __('Концерты'),
            'link' => url(path([LifeController::class, 'gigs'])),
            'description' => __('life.gigs.rss.description'),
        ];

        $items = Gig::where('status', GigStatus::Published)
            ->where('meta_image', '<>', '')
            ->take(50)
            ->orderByDesc('date')
            ->get()
            ->map($this->mapGig(...));

        return response()
            ->view('life.feed-rss', ['items' => $items, 'meta' => $meta])
            ->header('Content-Type', 'application/xml');
    }

    private function mapGig(Gig $gig): array
    {
        $link = url($gig->www());
        $cover = '<p><a href="' . $link . '?from=rss-image"><img src="' . $gig->meta_image . '" alt=""></a></p>';

        return [
            'title' => htmlspecialchars($gig->metaTitle()),
            'link' => $link . '?from=rss-title',
            'guid' => $link,
            'description' => "<p>{$gig->metaDescription()}</p>{$cover}",
            'pubDate' => $gig->date->toRfc2822String(),
        ];
    }
}
