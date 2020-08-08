<?php namespace App\Http\Controllers;

use App\Gig;

class GigsRssController extends Controller
{
    public function __invoke()
    {
        $meta = [
            'title' => __('Концерты'),
            'link' => url(path([Life::class, 'gigs'])),
            'description' => trans('life.gigs.rss.description'),
        ];

        $items = Gig::where('status', Gig::STATUS_PUBLISHED)
            ->where('meta_image', '<>', '')
            ->take(50)
            ->orderByDesc('date')
            ->get()
            ->map(function (Gig $gig) {
                $link = url($gig->www());
                $cover = '<p><a href="' . $link . '?from=rss-image"><img src="' . $gig->meta_image . '" alt=""></a></p>';

                return [
                    'title' => htmlspecialchars($gig->metaTitle()),
                    'link' => $link . '?from=rss-title',
                    'guid' => $link,
                    'description' => "<p>{$gig->metaDescription()}</p>{$cover}",
                    'pubDate' => $gig->date->toRfc2822String(),
                ];
            });

        return response()
            ->view('life.feed-rss', ['items' => $items, 'meta' => $meta])
            ->header('Content-Type', 'application/xml');
    }
}
