<?php namespace App\Action;

use App\Domain\ImageViewsAggregator;
use App\Domain\MetricsAggregator;
use App\Domain\PhotoViewsAggregator;
use App\Domain\ViewsAggregator;
use App\Events\Stats\GalleryImageViewed;
use App\Events\Stats\Photo1000Viewed;
use App\Events\Stats\Photo2000Viewed;

class HandleMetricPayloadAction
{
    public function execute(
        array $json,
        MetricsAggregator $metricsAggregator,
        ViewsAggregator $viewsAggregator,
        ImageViewsAggregator $imageViewsAggregator,
        PhotoViewsAggregator $photoViewsAggregator
    ): void {
        foreach ($json as $payload) {
            if (empty($payload['event'])) {
                continue;
            }

            $event = $payload['event'];

            $metricsAggregator->push($event);

            if (empty($payload['data'])) {
                continue;
            }

            if ($event === class_basename(GalleryImageViewed::class)) {
                $imageViewsAggregator->push(GalleryImageViewed::fromArray($payload['data'])->dateAndSlug);

                continue;
            }

            match ($event) {
                class_basename(Photo1000Viewed::class),
                class_basename(Photo2000Viewed::class) => $photoViewsAggregator->push($payload['data']['slug']),
                default => null,
            };

            if (str_ends_with($event, 'Viewed')) {
                $id = intval($payload['data']['id'] ?? 0);
                $table = $payload['data']['table'] ?? null;

                if ($id > 0 && preg_match('/^[a-z_]+$/', $table)) {
                    $viewsAggregator->push($table, $id);
                }
            }
        }
    }
}
