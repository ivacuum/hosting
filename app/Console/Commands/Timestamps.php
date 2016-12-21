<?php namespace App\Console\Commands;

use App\File;
use App\Image;
use App\News;
use Carbon\Carbon;

class Timestamps extends Command
{
    protected $signature = 'app:timestamps';
    protected $description = 'Convert unixtime to timestamps';

    public function handle()
    {
        /*
        File::orderBy('id')->chunk(1000, function ($files) {
            foreach ($files as $file) {
                if (is_null($file->created_at)) {
                    $file->created_at = $file->updated_at = Carbon::createFromTimestamp($file->time);
                    $file->save();
                }
            }
        });
        */

        Image::orderBy(Image::ID)->chunk(1000, function ($images) {
            foreach ($images as $image) {
                if (is_null($image->created_at)) {
                    $image->created_at = Carbon::createFromTimestamp($image->time);
                }

                if (is_null($image->updated_at)) {
                    if ($image->touch) {
                        $image->updated_at = Carbon::createFromTimestamp($image->touch);
                    } else {
                        $image->updated_at = $image->created_at;
                    }
                }

                $image->save();
            }
        });

        /*
        News::orderBy('id')->chunk(1000, function ($news_collection) {
            foreach ($news_collection as $news) {
                if (is_null($news->created_at)) {
                    $news->created_at = $news->updated_at = Carbon::createFromTimestamp($news->time);
                    $news->save();
                }
            }
        });
        */
    }
}
