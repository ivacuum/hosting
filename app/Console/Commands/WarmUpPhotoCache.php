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

        foreach ($this->models() as $model) {
            /** @var Photo $model */
            $promises = [
                $http->getAsync($model->originalUrl()),
                $http->getAsync($model->mobileUrl()),
                $http->getAsync($model->thumbnailUrl()),
            ];

            \GuzzleHttp\Promise\Utils::unwrap($promises);

            $i++;

            if ($i % 1000 === 0) {
                $this->info($i);
            }
        }

        if ($i % 1000 !== 0) {
            $this->info($i);
        }
    }

    protected function models()
    {
        return Photo::query()
            ->select(['id', 'slug'])
            ->orderBy('id')
            ->cursor();
    }
}
