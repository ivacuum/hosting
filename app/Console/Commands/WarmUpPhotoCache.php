<?php namespace App\Console\Commands;

use App\Photo;
use GuzzleHttp\Client;
use Ivacuum\Generic\Commands\Command;

class WarmUpPhotoCache extends Command
{
    protected $signature = 'app:warm-up-photo-cache';
    protected $description = 'Make sure Cloudflare has all the photos';

    public function handle(Client $http)
    {
        $i = 0;
        $promises = [];

        foreach ($this->models() as $model) {
            /* @var Photo $model */
            $promises[] = $http->getAsync($model->originalUrl());
            $promises[] = $http->getAsync($model->mobileUrl());
            $promises[] = $http->getAsync($model->thumbnailUrl());

            $i++;

            if ($i % 1000 === 0) {
                $this->info($i);
            }
        }

        if ($i % 1000 !== 0) {
            $this->info($i);
        }

        \GuzzleHttp\Promise\unwrap($promises);
    }

    protected function models()
    {
        return Photo::query()
            ->select(['id', 'slug'])
            ->orderBy('id')
            ->cursor();
    }
}
