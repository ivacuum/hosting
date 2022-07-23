<?php namespace App\Console\Commands;

use App\Photo;
use App\Spatial\Point;
use Ivacuum\Generic\Commands\Command;

class PhotoChore extends Command
{
    protected $signature = 'app:photo-chore';
    protected $description = '';

    public function handle()
    {
        Photo::query()
            ->where('lat', '<>', '')
            ->where('lon', '<>', '')
            ->whereNull('point')
            ->lazyById()
            ->each(function (Photo $photo) {
                if ($photo->point) {
                    return;
                }

                $photo->point = new Point($photo->lat, $photo->lon);
                $photo->save();

                dump("Photo {$photo->id}: {$photo->point->toWkt()}");
            });
    }
}
